<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Cache;
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
  
}
