<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

class GeneralSettingsController extends Controller
{
     public function index()
    {
        $settings = GeneralSetting::first();

        // Auto create if not exists
        if (!$settings) {
            $settings = GeneralSetting::create([
                'website_name' => 'My Website',
            ]);
        }

        return view('admin.settings.general', compact('settings'));
    }


   public function update(Request $request)
{
    $settings = GeneralSetting::getSettings();
    $section = $request->input('section');

    $data = [];

    switch ($section) {

        /* ---------------------------
           SITE INFO
        ---------------------------- */
        case 'site-info':
            $data['site_name'] = $request->input('site_name');
            $data['site_tagline'] = $request->input('site_tagline');
            $data['site_email'] = $request->input('site_email');
            $data['site_phone'] = $request->input('site_phone');
            $data['banner_title'] = $request->input('banner_title');
            $data['banner_subtitle'] = $request->input('banner_subtitle');
            break;


        /* ---------------------------
           BRANDING (logo + favicon)
        ---------------------------- */
        case 'branding':

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = public_path('uploads/general');
                $file->move($path, $filename);

                $data['logo'] = url('uploads/general/'.$filename);
            }

            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = public_path('uploads/general');
                $file->move($path, $filename);

                $data['favicon'] = url('uploads/general/'.$filename);
            }

            break;


        /* ---------------------------
           BANNER SECTION
        ---------------------------- */
        case 'banner':

            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/general'), $filename);
                $data['banner_image'] = url('uploads/general/'.$filename);
            }

            if ($request->hasFile('banner_mobile_image')) {
                $file = $request->file('banner_mobile_image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/general'), $filename);
                $data['banner_mobile_image'] = url('uploads/general/'.$filename);
            }

            if ($request->hasFile('banner_video')) {
                $file = $request->file('banner_video');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/general'), $filename);
                $data['banner_video'] = url('uploads/general/'.$filename);
            }

            $data['banner_video_enabled'] = $request->has('banner_video_enabled') ? 1 : 0;
            break;


        /* ---------------------------
           SEO
        ---------------------------- */
        case 'seo':
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');
            $data['meta_keywords'] = $request->input('meta_keywords');
            break;


        /* ---------------------------
           SOCIAL LINKS
        ---------------------------- */
        case 'socials':
            $data['facebook_url'] = $request->input('facebook_url');
            $data['instagram_url'] = $request->input('instagram_url');
            $data['twitter_url'] = $request->input('twitter_url');
            $data['tiktok_url'] = $request->input('tiktok_url');
            $data['linkedin_url'] = $request->input('linkedin_url');
            $data['youtube_url'] = $request->input('youtube_url');
            break;


        /* ---------------------------
           FOOTER
        ---------------------------- */
        case 'footer':
            $data['footer_about'] = $request->input('footer_about');

            if ($request->hasFile('footer_logo')) {
                $file = $request->file('footer_logo');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/general'), $filename);
                $data['footer_logo'] = url('uploads/general/'.$filename);
            }
            break;


        /* ---------------------------
           GLOBAL SETTINGS
        ---------------------------- */
        case 'global':
            $data['default_currency'] = $request->input('default_currency');
            $data['timezone'] = $request->input('timezone');
            $data['maintenance_mode'] = $request->has('maintenance_mode') ? 1 : 0;
            $data['maintenance_message'] = $request->input('maintenance_message');
            break;


        default:
            return redirect()->back()->with('error', 'Invalid section.');
    }

    // Update settings
    $settings->update($data);

    // Refresh cache
    Cache::forget('general_settings');
    Cache::rememberForever('general_settings', fn() => $settings->fresh());

    return redirect()->back()->with('success', ucfirst(str_replace('-', ' ', $section)).' updated successfully!');
}

public function delete(Request $request)
{
    $settings = GeneralSetting::getSettings();

    $section = $request->input('section');
    $field = $request->input('delete_field');

    if (!$field) {
        return redirect()->back()->with('error', 'Invalid delete request.');
    }

    // Only allow fields that actually exist in DB
    if (!array_key_exists($field, $settings->getAttributes())) {
        return redirect()->back()->with('error', 'Field does not exist.');
    }

    // If field contains a public URL, delete the physical file
    if (!empty($settings->$field) && str_contains($settings->$field, 'uploads/general')) {
        $filePath = str_replace(url('/').'/', '', $settings->$field);

        if (file_exists(public_path($filePath))) {
@unlink(public_path($filePath));
        }
    }

    // Set the field to null
    $settings->update([
        $field => null
    ]);

    Cache::forget('general_settings');
    Cache::rememberForever('general_settings', fn() => $settings->fresh());

    return redirect()->back()->with('success', ucfirst($field).' deleted successfully!');
}

public function profileSetting(){
    $user = Auth::user();

    return view('admin.settings.profile', compact('user'));
}
  
 // =============================
    //  UPDATE INFO (name, phone)
    // =============================
    public function updateInfo(Request $request)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only('first_name', 'last_name', 'phone'));

        return back()->with('success', 'Profile information updated successfully.');
    }


    // =============================
    //  UPDATE PROFILE PICTURE
    // =============================
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Store in /public/uploads/profile
        $file = $request->file('profile_picture');
        $path = $file->store('uploads/profile', 'public');

        // Convert to public URL
        $publicUrl = asset('storage/' . $path);

        $user->profile_picture = $publicUrl;
        $user->save();

        return back()->with('success', 'Profile picture updated successfully.');
    }


    // =============================
    //  UPDATE PASSWORD
    // =============================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'new_password'          => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }


    // =============================
    //  UPDATE ADDRESS
    // =============================
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address_line' => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:255',
            'state'        => 'nullable|string|max:255',
            'country'      => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'address_line' => $request->address_line,
            'city'         => $request->city,
            'state'        => $request->state,
            'country'      => $request->country,
        ]);

        return back()->with('success', 'Address updated successfully.');
    }


    // =============================
    //  ENABLE 2FA
    // =============================
    public function enable2FA(Request $request)
    {
        $request->validate([
            'two_factor_type' => 'required|in:sms,authenticator',
        ]);

        $user = Auth::user();

        $user->two_factor_enabled = 1;
        $user->two_factor_type = $request->two_factor_type;

        // OPTIONAL: Generate a code
        $user->two_factor_code = rand(100000, 999999);
        $user->two_factor_expires_at = now()->addMinutes(10);

        $user->save();

        return back()->with('success', 'Two-factor authentication enabled.');
    }


    // =============================
    //  DISABLE 2FA
    // =============================
    public function disable2FA()
    {
        $user = Auth::user();

        $user->two_factor_enabled = 0;
        $user->two_factor_type = null;
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;

        $user->save();

        return back()->with('success', 'Two-factor authentication disabled.');
    }
}
