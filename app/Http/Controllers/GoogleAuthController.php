<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
   public function callback(Request $request)
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // Check if email exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Split name into first/last
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);

            $user = User::create([
                'first_name' => $nameParts[0],
                'last_name'  => $nameParts[1] ?? '',
                'email'      => $googleUser->getEmail(),
                'google_id'  => $googleUser->getId(),
                'profile_picture' => $googleUser->getAvatar(),
                'phone' => null,        // Google does NOT return phone
                'country' => null,      // Socialite does NOT return country
                'city' => null,         // Socialite does NOT return city
                'email_verified_at' => now(),
            ]);
        } else {
            // If user exists but google_id empty → link Google account
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->save();
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', $user->wasRecentlyCreated
                ? 'Account created and logged in via Google!'
                : 'Logged in successfully via Google!');

    } catch (\Exception $e) {
        return redirect()->route('normal-login-user')->with('error', 'Failed to authenticate with Google.');
    }
}

}
