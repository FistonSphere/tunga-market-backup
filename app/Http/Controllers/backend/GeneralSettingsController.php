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
            case 'site-info':
                $data['site_name'] = $request->input('site_name');
                $data['site_tagline'] = $request->input('site_tagline');
                $data['site_email'] = $request->input('site_email');
                $data['site_phone'] = $request->input('site_phone');
                break;

            case 'branding':
                if ($request->hasFile('logo')) {
                    $logoPath = $request->file('logo')->store('public/images');
                    $data['logo'] = asset(Storage::url($logoPath));
                }

                if ($request->hasFile('favicon')) {
                    $faviconPath = $request->file('favicon')->store('public/images');
                    $data['favicon'] = asset(Storage::url($faviconPath));
                }
                break;

            case 'banner':
                if ($request->hasFile('banner_image')) {
                    $bannerPath = $request->file('banner_image')->store('public/images');
                    $data['banner_image'] = asset(Storage::url($bannerPath));
                }

                if ($request->hasFile('banner_mobile_image')) {
                    $bannerMobilePath = $request->file('banner_mobile_image')->store('public/images');
                    $data['banner_mobile_image'] = asset(Storage::url($bannerMobilePath));
                }

                if ($request->hasFile('banner_video')) {
                    $bannerVideoPath = $request->file('banner_video')->store('public/videos');
                    $data['banner_video'] = asset(Storage::url($bannerVideoPath));
                }

                $data['banner_video_enabled'] = $request->has('banner_video_enabled') ? true : false;
                break;

            case 'seo':
                $data['meta_title'] = $request->input('meta_title');
                $data['meta_description'] = $request->input('meta_description');
                $data['meta_keywords'] = $request->input('meta_keywords');
                break;

            case 'socials':
                $data['facebook_url'] = $request->input('facebook_url');
                $data['instagram_url'] = $request->input('instagram_url');
                $data['twitter_url'] = $request->input('twitter_url');
                $data['linkedin_url'] = $request->input('linkedin_url');
                $data['youtube_url'] = $request->input('youtube_url');
                break;

            case 'footer':
                $data['footer_about'] = $request->input('footer_about');

                if ($request->hasFile('footer_logo')) {
                    $footerLogoPath = $request->file('footer_logo')->store('public/images');
                    $data['footer_logo'] = asset(Storage::url($footerLogoPath));
                }
                break;

            case 'global':
                $data['default_currency'] = $request->input('default_currency');
                $data['timezone'] = $request->input('timezone');
                $data['maintenance_mode'] = $request->has('maintenance_mode') ? true : false;
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

        return redirect()->back()->with('success', ucfirst(str_replace('-', ' ', $section)) . ' updated successfully!');
    }  
}
