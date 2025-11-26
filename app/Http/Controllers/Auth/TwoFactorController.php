<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserSessionController;
use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use OTPHP\TOTP;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * 1.) Generate secret + QR when user clicks "Enable 2FA"
     */

public function generate(Request $request)
{
    $user = $request->user();

    if ($user->two_factor_enabled) {
        return response()->json([
            'status' => 'already_enabled',
            'message' => 'Two-factor authentication is already enabled.'
        ]);
    }

    // Generate secret key
    $secret = $this->google2fa->generateSecretKey();

    // Store in session
    $request->session()->put('two_factor_temp_secret', $secret);

    // Build provisioning URI
    $appName = config('app.name', 'Tunga Market');
    $email = $user->email;

    $provisioningUri = $this->google2fa->getQRCodeUrl($appName, $email, $secret);

    // Generate QR CODE SVG directly (NO Google API)
    $qrSvg = QrCode::format('svg')->size(200)->generate($provisioningUri);

    return response()->json([
        'status' => 'success',
        'secret' => $secret,
        'qr_code' => base64_encode($qrSvg), // send encoded SVG
    ]);
}


    /**
     * 2.) Enable 2FA after user submits TOTP code
     */
    public function enable(Request $request)
    {
        $request->validate([
            'one_time_code' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $request->user();

        // Check password for security
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wrong password.',
            ], 422);
        }

        // Get the temporary secret
        $secret = $request->session()->get('two_factor_temp_secret');
        if (!$secret) {
            return response()->json([
                'status' => 'expired',
                'message' => '2FA setup session expired. Reload setup.',
            ], 422);
        }

        // Validate OTP Code
        $valid = $this->google2fa->verifyKey($secret, $request->one_time_code);

        if (!$valid) {
            return response()->json([
                'status' => 'invalid_code',
                'message' => 'Invalid authentication code.',
            ], 422);
        }

        // Save secret permanently (encrypted)
        $user->two_factor_secret = encrypt($secret);
        $user->two_factor_enabled = true;
        $user->two_factor_confirmed_at = now();

        // Generate 8 recovery codes
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = Str::upper(Str::random(10));
        }

        $user->two_factor_recovery_codes = encrypt(json_encode($codes));
        $user->save();

        // Clear temporary session
        $request->session()->forget('two_factor_temp_secret');

        return response()->json([
            'status' => 'success',
            'message' => 'Two-factor authentication enabled.',
            'recovery_codes' => $codes,
        ]);
    }

    /**
     * 3.) Disable 2FA (requires password + code or recovery code)
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            'code' => 'nullable|string',
        ]);

        $user = $request->user();

        // Security check
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wrong password.',
            ], 422);
        }

        $code = $request->code;
        $secret = $user->two_factor_secret ? decrypt($user->two_factor_secret) : null;

        $valid = false;

        // Try verifying TOTP code
        if ($code && $secret) {
            $valid = $this->google2fa->verifyKey($secret, $code);
        }

        // Try recovery codes
        if (!$valid && $code) {
            $codes = json_decode(decrypt($user->two_factor_recovery_codes), true);

            $index = array_search($code, $codes);
            if ($index !== false) {
                unset($codes[$index]);
                $user->two_factor_recovery_codes = encrypt(json_encode(array_values($codes)));
                $valid = true;
            }
        }

        if (!$valid) {
            return response()->json([
                'status' => 'invalid_code',
                'message' => 'Invalid code. Provide valid TOTP or recovery code.',
            ], 422);
        }

        // Disable 2FA
        $user->two_factor_enabled = false;
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Two-factor authentication disabled.',
        ]);
    }

    public function downloadBackupCodes()
{
    $user = auth()->user();

    if (!$user->two_factor_enabled) {
        abort(403, '2FA not enabled.');
    }

    // Decrypt stored codes
    $codes = json_decode(decrypt($user->two_factor_recovery_codes), true);

    $pdf = Pdf::loadView('pdf.backup-codes', [
        'user' => $user,
        'codes' => $codes
    ]);

    return $pdf->download('backup-codes.pdf');
}




public function verifyLoginCode(Request $request)
{
    $request->validate([
        'code' => 'required|digits:6'
    ]);

    $userId = session('2fa:user:id');

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'Session expired']);
    }

    $user = User::find($userId);

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    $totp = TOTP::create($user->two_factor_secret);

    if (!$totp->verify($request->code)) {
        return response()->json(['success' => false, 'message' => 'Invalid 2FA code']);
    }

    // SUCCESS → LOG THE USER IN
    Auth::login($user);
    request()->session()->regenerate();

    (new UserSessionController())->store($request);

    // Clear temporary session
    session()->forget('2fa:user:id');

    if ($user->is_admin === 'yes') {
        return response()->json(['success' => true, 'redirect' => route('choose-login-mode')]);
    }

    return response()->json(['success' => true, 'redirect' => url('/')]);
}

}
