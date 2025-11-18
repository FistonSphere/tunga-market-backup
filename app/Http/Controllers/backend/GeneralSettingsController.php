<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
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
        $settings = GeneralSetting::firstOrCreate([]);

        $validated = $request->validate([
            'website_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,svg,ico,webp|max:1024',
            'banner_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
            'banner_video' => 'nullable|mimetypes:video/mp4,video/webm|max:20000',
        ]);

        // Save website name
        $settings->website_name = $validated['website_name'] ?? $settings->website_name;

        // Upload Logo (PUBLIC URL)
        if ($request->hasFile('logo')) {
            if ($settings->logo && file_exists(public_path($settings->logo))) {
                unlink(public_path($settings->logo));
            }

            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);

            $settings->logo = '/uploads/settings/' . $filename;
        }

        // Upload Favicon (PUBLIC URL)
        if ($request->hasFile('favicon')) {
            if ($settings->favicon && file_exists(public_path($settings->favicon))) {
                unlink(public_path($settings->favicon));
            }

            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);

            $settings->favicon = '/uploads/settings/' . $filename;
        }

        // Upload Banner Image
        if ($request->hasFile('banner_image')) {
            if ($settings->banner_image && file_exists(public_path($settings->banner_image))) {
                unlink(public_path($settings->banner_image));
            }

            $file = $request->file('banner_image');
            $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);

            $settings->banner_image = '/uploads/settings/' . $filename;
        }

        // Upload Banner Video
        if ($request->hasFile('banner_video')) {
            if ($settings->banner_video && file_exists(public_path($settings->banner_video))) {
                unlink(public_path($settings->banner_video));
            }

            $file = $request->file('banner_video');
            $filename = 'banner_video_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);

            $settings->banner_video = '/uploads/settings/' . $filename;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
