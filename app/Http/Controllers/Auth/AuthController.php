<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserSessionController;
use App\Mail\PasswordChangedNotification;
use App\Mail\SendOtpMail;
use App\Models\ContactRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Logic to show the login form

        return view('frontend.auth.auth'); // Adjust the view name as necessary
    }
   public function register(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|min:9',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // 🔹 Normalize phone number
    $rawPhone = $request->phone;
    $phone = preg_replace('/\s+/', '', $rawPhone); // remove spaces

    // If phone starts with 07 → assume Rwanda (+250)
    if (str_starts_with($phone, '07')) {
        $phone = '+25' . $phone; // 078xxxxxxx → +25078xxxxxxx
    }

    // If phone starts with 0 but not 07 → reject
    if (str_starts_with($phone, '0') && !str_starts_with($phone, '07')) {
        return response()->json(['error' => 'Invalid phone number format. Please include a supported country code.'], 422);
    }

    // 🔹 Allowed country codes
    $allowedCodes = ['+263', '+250', '+1', '+255', '+230', '+92', '+91'];

    $isAllowed = false;
    foreach ($allowedCodes as $code) {
        if (str_starts_with($phone, $code)) {
            $isAllowed = true;
            break;
        }
    }

    if (!$isAllowed) {
        return response()->json(['error' => 'Phone number not supported. Allowed countries: +263, +250, +1, +255, +230, +92, +91'], 422);
    }

    // 🔹 Generate OTP
    $otp = rand(1000, 9999);
    Log::info("OTP generated: $otp");

    $pendingUser = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $phone, // normalized & validated
        'password' => bcrypt($request->password),
        'otp' => $otp,
        'otp_expires_at' => now()->addMinutes(10),
    ];

    session(['pending_user' => $pendingUser]);
    Log::info('Pending user stored in session', ['email' => $request->email]);

    // 🔹 Send OTP via Email
    try {
        Mail::to($request->email)->send(new SendOtpMail((object) $pendingUser));
        Log::info("✅ OTP email successfully sent to {$request->email}");
    } catch (\Exception $e) {
        Log::error("❌ Failed to send OTP email: " . $e->getMessage());
    }

    // 🔹 Send OTP via SMS
    try {
        $apiToken = config('services.mista.api_token');
        $senderId = config('services.mista.sender_id');

        // OTP in both plain + clickable link
        $otpPlain = $pendingUser['otp'];

        $message = "Tunga Market\n"
            ."----------------------------------\n"
            ."Hello {$pendingUser['first_name']},\n\n"
            ."Thank you for signing up at Tunga Market.\n\n"
            ."Use the One-Time Password (OTP) below to complete your registration:\n\n"
            ."🔑 OTP: $otpPlain\n\n"
            ."⚠️ This code expires in 60 minutes. If you did not request this, please ignore.\n\n"
            ."Welcome to the community! 🎉\n"
            ."----------------------------------\n"
            ."© ".date('Y')." Tunga Market | Need help? Contact Support.";

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiToken,
        ])->post('https://api.mista.io/sms', [
            'recipient' => $phone,
            'sender_id' => $senderId,
            'message' => $message,
            'type' => 'plain',
        ]);

        if ($response->successful()) {
            Log::info("✅ OTP SMS successfully sent to {$phone}");
        } else {
            Log::error("❌ Failed to send OTP SMS. Response: " . $response->body());
        }
    } catch (\Exception $e) {
        Log::error("❌ SMS sending error: " . $e->getMessage());
    }

    return response()->json(['message' => 'OTP sent via Email and SMS.'], 200);
}



    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4', // ensure this is 4 digits
        ]);

        $pendingUser = session('pending_user');

        if (!$pendingUser) {
            return response()->json(['error' => 'No registration attempt found.'], 422);
        }

        if ($request->otp != $pendingUser['otp']) {
            return response()->json(['error' => 'Invalid OTP.'], 422);
        }

        if (now()->gt($pendingUser['otp_expires_at'])) {
            return response()->json(['error' => 'OTP expired.'], 422);
        }

        // Create user
        $user = User::create([
            'first_name' => $pendingUser['first_name'],
            'last_name' => $pendingUser['last_name'],
            'email' => $pendingUser['email'],
            'password' => $pendingUser['password'],
        ]);

        session()->forget('pending_user');
        auth()->login($user);

        return response()->json(['message' => 'Account created and verified successfully, now swipe to login.', 'redirect' => route('login')]);
    }

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }



    // Attempt login
    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ], $request->has('remember'))) {

        $request->session()->regenerate();
// Call store as an instance method
    $userSessionController = new UserSessionController();
    $userSessionController->store($request);
        return redirect()->intended()->with('success', 'Login successful!');
    }

    return back()->withErrors(['password' => 'The provided credentials are incorrect.'])->withInput();
}
    public function logout(Request $request)
    {
        auth()->logout();
        Session::flush();
        return redirect()->back()->with('message', 'You have been logged out successfully.');
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
         $countries = Countries::all()->pluck('name.common')->sort();
        $status = $request->get('status');
        $toDate = $request->get('to_date');
        $fromDate = $request->get('from_date');
          $orders = OrderItem::with(['order', 'product'])
        ->whereHas('order', function ($query) use ($status) {
            $query->where('user_id', auth()->id());

            // Status filter
            if ($status && strtolower($status) !== 'all') {
                $query->where('status', $status);
            }
        })
        // Date range filter on OrderItem's created_at
        ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ]);
        })
        ->when($fromDate && !$toDate, function ($query) use ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        })
        ->when(!$fromDate && $toDate, function ($query) use ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        })
        ->paginate(3)
        ->appends([
            'status' => $status,
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ]);

        $recentRequests = ContactRequest::where('email', $user->email)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Determine account status dynamically (example logic)
    $hasPending = $recentRequests->where('status', 'Pending')->count();
    $accountStatus = $hasPending ? 'Attention Required' : 'Account in Good Standing';
    $accountStatusColor = $hasPending ? 'bg-warning-100 text-warning-700' : 'bg-success-50 border-success-200 text-success-700';
        return view('frontend.auth.user-profile', compact('user', 'countries','orders','status','fromDate','toDate', 'recentRequests', 'accountStatus', 'accountStatusColor','hasPending'));
    }




      public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name'  => 'required|string|max:50',
        'phone'=> 'nullable|string|max:20',
        'city' => 'nullable|string|max:50',
        'country' => 'nullable|string|max:50',
        'state' => 'nullable|string|max:50',
        'address_line' => 'nullable|string|max:255',
        'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Store in 'profile_pictures' folder on the 'public' disk (this maps to storage/app/public)
        $path = $file->storeAs('profile_pictures', $filename, 'public');

        // Delete old picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists(str_replace('/storage/', '', parse_url($user->profile_picture, PHP_URL_PATH)))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', parse_url($user->profile_picture, PHP_URL_PATH)));
        }

        // Save full URL
        $user->profile_picture = asset('storage/' . $path);
    }

    $user->first_name = $validated['first_name'];
    $user->last_name = $validated['last_name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'] ?? null;
    $user->city = $validated['city'] ?? null;
    $user->country = $validated['country'] ?? null;
    $user->state = $validated['state'] ?? null;
    $user->address_line = $validated['address_line'] ?? null;
    $user->updated_at = Carbon::now();
    $user->save();

    return response()->json(['success' => true]);
}

public function updatePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'errors' => ['current_password' => ['The current password is incorrect.']]
        ], 422);
    }

    $user->password = Hash::make($request->new_password);
    // Send notification email
    Mail::to($user->email)->send(new PasswordChangedNotification($user, $request->new_password));
    $user->save();

    return response()->json(['message' => 'Password updated successfully.']);
}

 public function getUser(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated',
                'user' => null,
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'email' => $user->email,
            ]
        ]);
    }

public function delete(Request $request)
{
    $request->validate([
        'password' => 'required',
    ]);

    if (!Hash::check($request->password, $request->user()->password)) {
        return response()->json(['message' => 'Incorrect password.'], 403);
    }

    try {
        $user = $request->user();
        Auth::logout();
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully.']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error occurred while deleting account.'], 500);
    }
}


}
