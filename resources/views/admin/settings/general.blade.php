@extends('admin.layouts.header')

@section('content')
    <style>
        /* ---------- Container ---------- */
        .settings-container {
            font-family: 'Inter', sans-serif;
            padding: 2rem;
            background-color: #f4f6fa;
            min-height: 100vh;
        }

        /* ---------- Header ---------- */
        .settings-header h1 {
            font-size: 2rem;
            color: #001528;
            margin-bottom: 0.2rem;
            font-weight: 600;
        }

        .settings-header p {
            color: #6b7c93;
            font-size: 0.95rem;
        }

        /* ---------- Tabs Navigation ---------- */
        .tabs {
            display: flex;
            flex-wrap: wrap;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .tab-button {
            padding: 0.6rem 1.2rem;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.95rem;
            color: #001528;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: #001528;
            color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .tab-button:hover:not(.active) {
            background: #ff5f0e;
            color: #fff;
        }

        /* ---------- Tab Content ---------- */
        .tab-content {
            margin-top: 2rem;
        }

        .tab-panel {
            display: none;
            animation: fadeIn 0.35s ease-in-out;
        }

        .tab-panel.active {
            display: block;
        }

        /* ---------- Cards ---------- */
        .settings-card {
            background: #fff;
            padding: 1.8rem;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .settings-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            border-left: 4px solid #ff5f0e;
        }

        .settings-card h2 {
            font-size: 1.25rem;
            color: #001528;
            margin-bottom: 1rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* ---------- Buttons ---------- */
        .edit-btn {
            background: #001528;
            color: #fff;
            border: none;
            padding: 0.35rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .edit-btn:hover {
            background: #ff5f0e;
        }

        .save-btn {
            background: #ff5f0e;
            color: #fff;
            border: none;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 0.6rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .save-btn:hover {
            background: #e55300;
        }

        .cancel-btn {
            background: #001528;
            color: #fff;
            border: none;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .cancel-btn:hover {
            background: #3b5278;
        }

        /* ---------- Display / Edit Mode ---------- */
        .display-mode p {
            font-size: 0.95rem;
            color: #3c4b5a;
            margin: 0.3rem 0;
            line-height: 1.5;
        }

        .display-mode span {
            font-weight: 500;
        }

        .edit-mode label {
            display: block;
            margin: 0.6rem 0;
            font-weight: 500;
        }

        .edit-mode input[type="text"],
        .edit-mode input[type="email"],
        .edit-mode input[type="url"],
        .edit-mode textarea,
        .edit-mode input[type="file"] {
            width: 100%;
            padding: 0.55rem;
            margin-top: 0.3rem;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .edit-mode input:focus,
        .edit-mode textarea:focus {
            outline: none;
            border-color: #ff5f0e;
            box-shadow: 0 0 6px rgba(255, 95, 14, 0.25);
        }

        .edit-mode textarea {
            resize: vertical;
            min-height: 70px;
        }

        /* ---------- Images / Video ---------- */
        .image-preview img,
        .banner-preview,
        .footer-logo {
            max-width: 100%;
            border-radius: 12px;
            margin-top: 0.5rem;
            transition: transform 0.3s;
            height: 100px;
            object-fit: cover;
        }

        .image-preview img:hover,
        .banner-preview:hover,
        .footer-logo:hover {
            transform: scale(1.03);
        }

        /* ---------- Animations ---------- */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ---------- Responsive ---------- */
        @media(max-width: 768px) {
            .settings-container {
                padding: 1rem;
            }

            .tabs {
                flex-direction: column;
            }

            .settings-card {
                padding: 1.2rem;
            }
        }

        .delete-btn {
            background: #ff5f0e;
            color: #fff;
            border: none;
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            cursor: pointer;
            margin: 5px 0 15px 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s ease-in-out;
        }

        .delete-btn:hover {
            background: #d94d00;
            transform: translateY(-1px);
        }

        .delete-btn i {
            font-size: 14px;
        }

        .delete-wrapper {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 12px;
        }

        .delete-wrapper form {
            display: inline-block;
        }
    </style>

    <div class="settings-container">

        <!-- Header -->
        <div class="settings-header">
            <h1>General Settings Overview</h1>
            <p>Manage all your site settings efficiently from one page.</p>
        </div>

        <!-- Tabs Navigation -->
        <div class="tabs">
            <button class="tab-button active" data-tab="site-info">Site Info</button>
            <button class="tab-button" data-tab="branding">Branding</button>
            <button class="tab-button" data-tab="banner">Banner / Hero</button>
            <button class="tab-button" data-tab="seo">SEO</button>
            <button class="tab-button" data-tab="socials">Socials</button>
            <button class="tab-button" data-tab="footer">Footer</button>
            <button class="tab-button" data-tab="global">Global / Maintenance</button>
        </div>

        <!-- Tabs Content -->
        <div class="tab-content">

            <!-- SITE INFO -->
            <div class="tab-panel active" id="site-info">
                <div class="settings-card">
                    <h2>Site Info
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        <p><strong>Name:</strong> <span>{{ $settings->site_name ?? 'Not set' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="site-info">
                            <input type="hidden" name="delete_field" value="site_name">
                            <button type="submit" class="delete-btn">Delete Site Name</button>
                        </form>
                        <p><strong>Tagline:</strong> <span>{{ $settings->site_tagline ?? 'Not set' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="site-info">
                            <input type="hidden" name="delete_field" value="site_tagline">
                            <button type="submit" class="delete-btn">Delete Site Tagline</button>
                        </form>
                        <p><strong>Email:</strong> <span>{{ $settings->site_email ?? 'Not set' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="site-info">
                            <input type="hidden" name="delete_field" value="site_email">
                            <button type="submit" class="delete-btn">Delete Site Email</button>
                        </form>
                        <p><strong>Phone:</strong> <span>{{ $settings->site_phone ?? 'Not set' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="site-info">
                            <input type="hidden" name="delete_field" value="site_phone">
                            <button type="submit" class="delete-btn">Delete Site phone</button>
                        </form>
                        <p><strong>Banner Title:</strong> <span>{{ $settings->banner_title ?? 'Not set' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="site-info">
                            <input type="hidden" name="delete_field" value="banner_title">
                            <button type="submit" class="delete-btn">Delete Banner Title</button>
                        </form>
                        <p><strong>Banner Subtitle:</strong> <span>{{ $settings->banner_subtitle ?? 'Not set' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="site-info">
                            <input type="hidden" name="delete_field" value="banner_subtitle">
                            <button type="submit" class="delete-btn">Delete Banner Subtitle</button>
                        </form>
                    </div>
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}">
                        @csrf
                        <input type="hidden" name="section" value="site-info">
                        <label>Name: <input type="text" name="site_name" value="{{ $settings->site_name }}"></label>

                        <label>Tagline: <input type="text" name="site_tagline"
                                value="{{ $settings->site_tagline }}"></label>
                        <label>Email: <input type="email" name="site_email" value="{{ $settings->site_email }}"></label>
                        <label>Phone: <input type="text" name="site_phone" value="{{ $settings->site_phone }}"></label>
                        <label>Banner Title: <input type="text" name="banner_title"
                                value="{{ $settings->banner_title }}"></label>
                        <label>Banner Subtitle: <input type="text" name="banner_subtitle"
                                value="{{ $settings->banner_subtitle }}"></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- BRANDING -->
            <div class="tab-panel" id="branding">
                <div class="settings-card">
                    <h2>Branding
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        <div class="image-preview">
                            <p>Logo:</p>
                            <img src="{{ $settings->logo ?? asset('assets/images/no-image.png') }}" alt="Logo">
                        </div>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="branding">
                            <input type="hidden" name="delete_field" value="logo">
                            <button type="submit" class="delete-btn">Delete Logo</button>
                        </form>
                        <div class="image-preview">
                            <p>Favicon:</p>
                            <img src="{{ $settings->favicon ?? asset('assets/images/no-image.png') }}" alt="Favicon">
                        </div>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="branding">
                            <input type="hidden" name="delete_field" value="favicon">
                            <button type="submit" class="delete-btn">Delete Favicon</button>
                        </form>
                    </div>
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="branding">
                        <label>Logo: <input type="file" name="logo"></label>
                        <label>Favicon: <input type="file" name="favicon"></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>

                </div>
            </div>

            <!-- BANNER / HERO -->
            <div class="tab-panel" id="banner">
                <div class="settings-card">
                    <h2>Banner / Hero
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        {{-- @if($settings->banner_video_enabled && $settings->banner_video) --}}
                        <div class="image-preview">
                            <video controls width="100%" class="banner-preview">
                                <source src="{{ $settings->banner_video }}" type="video/mp4">
                            </video>
                            <form method="POST" action="{{ route('general-settings.delete') }}">
                                @csrf
                                <input type="hidden" name="section" value="banner">
                                <input type="hidden" name="delete_field" value="banner_video">
                                <button type="submit" class="delete-btn">Delete Banner Video</button>
                            </form>
                        </div>
                        {{-- @else --}}
                        <div class="image-preview">
                            <img src="{{ $settings->banner_image ?? asset('assets/images/no-image.png') }}" alt="Banner"
                                class="banner-preview">
                            <form method="POST" action="{{ route('general-settings.delete') }}">
                                @csrf
                                <input type="hidden" name="section" value="banner">
                                <input type="hidden" name="delete_field" value="banner_image">
                                <button type="submit" class="delete-btn">Delete Banner Image</button>
                            </form>
                        </div>
                        <div class="image-preview">
                            <img src="{{ $settings->banner_mobile_image ?? asset('assets/images/no-image.png')}}"
                                alt="Banner" class="banner-preview">
                            <form method="POST" action="{{ route('general-settings.delete') }}">
                                @csrf
                                <input type="hidden" name="section" value="banner">
                                <input type="hidden" name="delete_field" value="banner_mobile_image">
                                <button type="submit" class="delete-btn">Delete Banner Mobile Image</button>
                            </form>

                        </div>
                        {{-- @endif --}}
                    </div>

                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="banner">
                        <label>Banner Image: <input type="file" name="banner_image"></label>
                        <label>Banner Mobile Image: <input type="file" name="banner_mobile_image"></label>
                        <label>Banner Video: <input type="file" name="banner_video"></label>
                        <label>
                            Enable Video:
                            <input type="checkbox" name="banner_video_enabled" {{ $settings->banner_video_enabled ? 'checked' : '' }}>
                        </label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- SEO -->
            <div class="tab-panel" id="seo">
                <div class="settings-card">
                    <h2>SEO Settings
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        <p><strong>Meta Title:</strong> <span>{{ $settings->meta_title ?? '-' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="seo">
                            <input type="hidden" name="delete_field" value="meta_title">
                            <button type="submit" class="delete-btn">Delete Meta Title</button>
                        </form>

                        <p><strong>Description:</strong> <span>{{ $settings->meta_description ?? '-' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="seo">
                            <input type="hidden" name="delete_field" value="meta_description">
                            <button type="submit" class="delete-btn">Delete Meta Description</button>
                        </form>
                        <p><strong>Keywords:</strong> <span>{{ $settings->meta_keywords ?? '-' }}</span></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="seo">
                            <input type="hidden" name="delete_field" value="meta_keywords">
                            <button type="submit" class="delete-btn">Delete Meta Keywords</button>
                        </form>
                    </div>
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}">
                        @csrf
                        <input type="hidden" name="section" value="seo">
                        <label>Meta Title: <input type="text" name="meta_title" value="{{ $settings->meta_title }}"></label>
                        <label>Meta Description: <textarea
                                name="meta_description">{{ $settings->meta_description }}</textarea></label>
                        <label>Meta Keywords: <textarea
                                name="meta_keywords">{{ $settings->meta_keywords }}</textarea></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- SOCIALS -->
            <div class="tab-panel" id="socials">
                <div class="settings-card">
                    <h2>Social Links
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        <p><strong>Facebook:</strong> <a href="{{ $settings->facebook_url }}"
                                target="_blank">{{ $settings->facebook_url }}</a></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="socials">
                            <input type="hidden" name="delete_field" value="facebook_url">
                            <button type="submit" class="delete-btn">Delete Facebook Link</button>
                        </form>

                        <p><strong>Instagram:</strong> <a href="{{ $settings->instagram_url }}"
                                target="_blank">{{ $settings->instagram_url }}</a></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="socials">
                            <input type="hidden" name="delete_field" value="instagram_url">
                            <button type="submit" class="delete-btn">Delete Instagram Link</button>
                        </form>

                        <p><strong>Twitter:</strong> <a href="{{ $settings->twitter_url }}"
                                target="_blank">{{ $settings->twitter_url }}</a></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="socials">
                            <input type="hidden" name="delete_field" value="twitter_url">
                            <button type="submit" class="delete-btn">Delete Twitter Link</button>
                        </form>

                        <p><strong>TikTok:</strong> <a href="{{ $settings->tiktok_url }}"
                                target="_blank">{{ $settings->tiktok_url }}</a></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="socials">
                            <input type="hidden" name="delete_field" value="tiktok_url">
                            <button type="submit" class="delete-btn">Delete TikTok Link</button>
                        </form>

                        <p><strong>LinkedIn:</strong> <a href="{{ $settings->linkedin_url }}"
                                target="_blank">{{ $settings->linkedin_url }}</a></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="socials">
                            <input type="hidden" name="delete_field" value="linkedin_url">
                            <button type="submit" class="delete-btn">Delete Linkedin Link</button>
                        </form>

                        <p><strong>YouTube:</strong> <a href="{{ $settings->youtube_url }}"
                                target="_blank">{{ $settings->youtube_url }}</a></p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="socials">
                            <input type="hidden" name="delete_field" value="youtube_url">
                            <button type="submit" class="delete-btn">Delete YouTube Link</button>
                        </form>

                    </div>
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}">
                        @csrf
                        <input type="hidden" name="section" value="socials">
                        <label>Facebook: <input type="url" name="facebook_url"
                                value="{{ $settings->facebook_url }}"></label>
                        <label>Instagram: <input type="url" name="instagram_url"
                                value="{{ $settings->instagram_url }}"></label>
                        <label>Twitter: <input type="url" name="twitter_url" value="{{ $settings->twitter_url }}"></label>
                        <label>TikTok: <input type="url" name="tiktok_url" value="{{ $settings->tiktok_url }}"></label>
                        <label>LinkedIn: <input type="url" name="linkedin_url"
                                value="{{ $settings->linkedin_url }}"></label>
                        <label>YouTube: <input type="url" name="youtube_url" value="{{ $settings->youtube_url }}"></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="tab-panel" id="footer">
                <div class="settings-card">
                    <h2>Footer
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        <p>{{ $settings->footer_about ?? '-' }}</p>
                        <form method="POST" action="{{ route('general-settings.delete') }}">
                            @csrf
                            <input type="hidden" name="section" value="footer">
                            <input type="hidden" name="delete_field" value="footer_about">
                            <button type="submit" class="delete-btn">Delete Footer About</button>
                        </form>
                        <div class="image-preview">
                            <img src="{{ $settings->footer_logo ?? asset('assets/images/no-image.png') }}" alt="Footer Logo"
                                class="footer-logo">
                            <form method="POST" action="{{ route('general-settings.delete') }}">
                                @csrf
                                <input type="hidden" name="section" value="footer">
                                <input type="hidden" name="delete_field" value="footer_logo">
                                <button type="submit" class="delete-btn">Delete Footer Logo</button>
                            </form>
                        </div>
                    </div>
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="footer">
                        <label>Footer About: <textarea name="footer_about">{{ $settings->footer_about }}</textarea></label>
                        <label>Footer Logo: <input type="file" name="footer_logo"></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- GLOBAL / MAINTENANCE -->
            <div class="tab-panel" id="global">
                <div class="settings-card">
                    <h2>Global Settings
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                        <p><strong>Currency:</strong> {{ $settings->default_currency }}</p>
                        <p><strong>Timezone:</strong> {{ $settings->timezone }}</p>
                        <p><strong>Maintenance Mode:</strong> {{ $settings->maintenance_mode ? 'Enabled' : 'Disabled' }}</p>
                        @if($settings->maintenance_mode)
                            <p><strong>Message:</strong> {{ $settings->maintenance_message ?? '-' }}</p>
                        @endif
                    </div>
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}">
                        @csrf
                        <input type="hidden" name="section" value="global">
                        <label>Default Currency: <input type="text" name="default_currency"
                                value="{{ $settings->default_currency }}"></label>
                        <label>Timezone: <input type="text" name="timezone" value="{{ $settings->timezone }}"></label>
                        <label>Maintenance Mode: <input type="checkbox" name="maintenance_mode" {{ $settings->maintenance_mode ? 'checked' : '' }}></label>
                        <label>Maintenance Message: <textarea
                                name="maintenance_message">{{ $settings->maintenance_message }}</textarea></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script>
        function toggleEdit(button, cancel = false) {
            const card = button.closest('.settings-card');
            const display = card.querySelector('.display-mode');
            const form = card.querySelector('.edit-mode');

            if (cancel) {
                display.style.display = 'block';
                form.style.display = 'none';
                return;
            }

            if (form.style.display === 'none') {
                display.style.display = 'none';
                form.style.display = 'block';
            } else {
                display.style.display = 'block';
                form.style.display = 'none';
            }
        }




        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                const tab = button.dataset.tab;

                // Remove active class from all buttons
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Show corresponding tab panel
                document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));
                document.getElementById(tab).classList.add('active');
            });
        });
    </script>


@endsection