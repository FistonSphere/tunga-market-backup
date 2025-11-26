<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    // Show setup page where secret & QR are created (store secret in session until confirmed)
    public function showSetup(Request $request)
    {
        $user = $request->user();

        // if already enabled, show manage page
        if ($user->two_factor_enabled) {
            return view('auth.2fa.manage', ['user' => $user]);
        }

        // generate a secret and provisioning URI and QR (store secret temporarily in session)
        $secret = $this->google2fa->generateSecretKey();
        $request->session()->put('two_factor_temp_secret', $secret);

        $appName = config('app.name', 'MyApp');
        $email = $user->email;
        $provisioningUri = $this->google2fa->getQRCodeUrl($appName, $email, $secret);

        // Use Google Chart API for QR image
        $qrCodeUrl = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=' . urlencode($provisioningUri);

        return view('auth.2fa.setup', compact('user', 'secret', 'qrCodeUrl'));
    }

    // Confirm the code the user scanned
    public function confirmSetup(Request $request)
    {
        $request->validate([
            'one_time_code' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $request->user();

        // verify user's password before enabling
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Wrong password.'])->withInput();
        }

        $secret = $request->session()->get('two_factor_temp_secret');
        if (!$secret) {
            return back()->withErrors(['one_time_code' => 'Setup session expired. Please try again.']);
        }

        $valid = $this->google2fa->verifyKey($secret, $request->one_time_code);

        if (!$valid) {
            return back()->withErrors(['one_time_code' => 'Invalid code. Please try again.'])->withInput();
        }

        // save secret encrypted, mark enabled, generate recovery codes
        $user->two_factor_secret = encrypt($secret);
        $user->two_factor_enabled = true;
        $user->two_factor_confirmed_at = now();

        // generate recovery codes (8 codes)
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = Str::upper(Str::random(10));
        }
        $user->two_factor_recovery_codes = encrypt(json_encode($codes));

        $user->save();

        // remove temp secret
        $request->session()->forget('two_factor_temp_secret');

        return redirect()->route('2fa.manage')->with('success', 'Two-factor authentication enabled. Save your recovery codes in a safe place.');
    }

    // Manage page (show recovery codes, allow regenerate, disable)
    public function manage(Request $request)
    {
        $user = $request->user();
        return view('auth.2fa.manage', compact('user'));
    }

    // Regenerate recovery codes
    public function regenerateRecovery(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = $request->user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Wrong password.']);
        }

        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = Str::upper(Str::random(10));
        }

        $user->two_factor_recovery_codes = encrypt(json_encode($codes));
        $user->save();

        return back()->with('success', 'Recovery codes regenerated.');
    }

    // Disable 2FA
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            'code' => 'nullable|string',
        ]);

        $user = $request->user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Wrong password.']);
        }

        // If supplied with TOTP code or recovery code, verify
        $code = $request->code;
        $secret = $user->two_factor_secret ? decrypt($user->two_factor_secret) : null;

        $valid = false;
        if ($code && $secret) {
            $valid = $this->google2fa->verifyKey($secret, $code);
        }

        // if not valid as TOTP, try recovery codes
        if (!$valid && $code) {
            $recovery = $user->recoveryCodes;
            $idx = array_search($code, $recovery);
            if ($idx !== false) {
                // consume recovery code
                unset($recovery[$idx]);
                $user->setRecoveryCodes(array_values($recovery));
                $valid = true;
            }
        }

        if (!$valid) {
            return back()->withErrors(['code' => 'Invalid code. Provide a TOTP or a recovery code.']);
        }

        // disable
        $user->two_factor_enabled = false;
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();

        return redirect()->route('profile')->with('success', 'Two-factor authentication disabled.');
    }

    // Show verify form when user logged in but needs to verify
    public function showVerify()
    {
        return view('auth.2fa.verify');
    }

    // Verify after login
    public function verify(Request $request)
    {
        $request->validate([
            'one_time_code' => 'nullable|string',
            'recovery_code' => 'nullable|string',
        ]);

        $user = $request->user();

        // If no 2FA or already verified, redirect
        if (!$user->two_factor_enabled) {
            session()->put('two_factor_passed', true);
            return redirect()->intended('/');
        }

        $secret = $user->two_factor_secret ? decrypt($user->two_factor_secret) : null;
        $code = $request->one_time_code;
        $recovery = $request->recovery_code;

        $valid = false;
        if ($code && $secret) {
            $valid = $this->google2fa->verifyKey($secret, $code);
        }

        if (!$valid && $recovery) {
            $codes = $user->recoveryCodes;
            $idx = array_search($recovery, $codes);
            if ($idx !== false) {
                // consume recovery code
                unset($codes[$idx]);
                $user->setRecoveryCodes(array_values($codes));
                $valid = true;
            }
        }

        if (!$valid) {
            return back()->withErrors(['one_time_code' => 'Invalid code or recovery code.']);
        }

        // passed
        session()->put('two_factor_passed', true);
        return redirect()->intended('/'); // or intended route
    }
}
