@extends('admin.layouts.header')

<!-- resources/views/admin/general-settings.blade.php -->
<!-- Assuming you have a base admin layout -->

@section('content')
    <style>
        /* Container */
        .settings-container {
            font-family: 'Inter', sans-serif;
            padding: 2rem;
            background-color: #f4f6fa;
        }

        /* Header */
        .settings-header h1 {
            font-size: 2rem;
            color: #1f2a38;
            margin-bottom: 0.2rem;
        }

        .settings-header p {
            color: #6b7c93;
            font-size: 0.95rem;
        }

        /* Tabs Navigation */
        .tabs {
            display: flex;
            flex-wrap: wrap;
            margin-top: 1.5rem;
            gap: 0.5rem;
        }

        .tab-button {
            padding: 0.5rem 1rem;
            background-color: #e0e7ff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            color: #1f2a38;
            transition: all 0.2s;
        }

        .tab-button.active {
            background-color: #001427;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .tab-button:hover:not(.active) {
            background-color: #ff5f0e;
            color: #fff;
        }

        /* Tab Content */
        .tab-content {
            margin-top: 1.5rem;
        }

        /* Tab Panels */
        .tab-panel {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .tab-panel.active {
            display: block;
        }

        /* Card */
        .settings-card {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .settings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .settings-card h2 {
            font-size: 1.2rem;
            color: #0d1a2b;
            margin-bottom: 0.8rem;
        }

        /* Links */
        .settings-card a {
            color: #1a73e8;
            text-decoration: none;
        }

        .settings-card a:hover {
            text-decoration: underline;
        }

        /* Images */
        .image-preview img,
        .banner-preview,
        .footer-logo {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 0.5rem;
        }

        /* Banner / video */
        .banner-preview {
            display: block;
            margin-top: 0.5rem;
            border-radius: 10px;
        }

        /* Text elements */
        .settings-card p {
            font-size: 0.95rem;
            color: #3c4b5a;
            margin: 0.3rem 0;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media(max-width: 768px) {
            .settings-container {
                padding: 1rem;
            }

            .tabs {
                flex-direction: column;
            }
        }

        /* Buttons inside cards */
        .edit-btn {
            float: right;
            background-color: #1e40af;
            color: #fff;
            border: none;
            padding: 0.3rem 0.6rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .save-btn {
            background-color: #10b981;
            color: #fff;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        .cancel-btn {
            background-color: #ef4444;
            color: #fff;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 0.5rem;
        }

        /* Form inside card */
        .edit-mode label {
            display: block;
            margin: 0.5rem 0;
        }

        .edit-mode input[type="text"],
        .edit-mode input[type="email"],
        .edit-mode input[type="url"] {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.2rem;
            border-radius: 5px;
            border: 1px solid #d1d5db;
        }

        /* Display mode text span */
        .display-mode span {
            font-weight: 500;
        }
    </style>
    <div class="settings-container">

        <!-- Header -->
        <div class="settings-header">
            <h1>General Settings Overview</h1>
            <p>Manage all your site settings efficiently from one place.</p>
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

            <!-- Site Info -->
            <div class="tab-panel active" id="site-info">
                <div class="settings-card">
                    <h2>Site Info
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <!-- Display -->
                    <div class="display-mode">
                        <p><strong>Name:</strong> <span>{{ $settings->site_name ?? 'Not set' }}</span></p>
                        <p><strong>Tagline:</strong> <span>{{ $settings->site_tagline ?? 'Not set' }}</span></p>
                        <p><strong>Email:</strong> <span>{{ $settings->site_email ?? 'Not set' }}</span></p>
                        <p><strong>Phone:</strong> <span>{{ $settings->site_phone ?? 'Not set' }}</span></p>
                    </div>

                    <!-- Edit Form -->
                    <form class="edit-mode" style="display:none;" method="POST"
                        action="{{ route('general-settings.update') }}">
                        @csrf
                        <input type="hidden" name="section" value="site-info">
                        <label>Name: <input type="text" name="site_name" value="{{ $settings->site_name }}"></label>
                        <label>Tagline: <input type="text" name="site_tagline"
                                value="{{ $settings->site_tagline }}"></label>
                        <label>Email: <input type="email" name="site_email" value="{{ $settings->site_email }}"></label>
                        <label>Phone: <input type="text" name="site_phone" value="{{ $settings->site_phone }}"></label>
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(this, true)">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Branding -->
            <div class="tab-panel" id="branding">
                <div class="settings-card">
                    <h2>Branding
                        <button class="edit-btn" onclick="toggleEdit(this)">Edit</button>
                    </h2>
                    <div class="display-mode">
                            <div class="image-preview">
                                <p>Logo:</p>
                                <img src="{{ $settings->logo ?? 'https://via.placeholder.com/150' }}" alt="Logo">
                            </div>
                            <div class="image-preview">
                                <p>Favicon:</p>
                                <img src="{{ $settings->favicon ?? 'https://via.placeholder.com/50' }}" alt="Favicon">
                            </div>
                    </div>
                </div>
            </div>

            <!-- Banner -->
            <div class="tab-panel" id="banner">
                <div class="settings-card">
                    <h2>Banner / Hero</h2>
                    @if($settings->banner_video_enabled && $settings->banner_video)
                        <video controls width="100%" class="banner-preview">
                            <source src="{{ $settings->banner_video }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img src="{{ $settings->banner_image ?? 'https://via.placeholder.com/300x150' }}" alt="Banner"
                            class="banner-preview">
                    @endif
                </div>
            </div>

            <!-- SEO -->
            <div class="tab-panel" id="seo">
                <div class="settings-card">
                    <h2>SEO Settings</h2>
                    <p><strong>Meta Title:</strong> {{ $settings->meta_title ?? '-' }}</p>
                    <p><strong>Description:</strong> {{ $settings->meta_description ?? '-' }}</p>
                    <p><strong>Keywords:</strong> {{ $settings->meta_keywords ?? '-' }}</p>
                </div>
            </div>

            <!-- Socials -->
            <div class="tab-panel" id="socials">
                <div class="settings-card">
                    <h2>Social Links</h2>
                    <p><strong>Facebook:</strong> <a href="{{ $settings->facebook_url }}"
                            target="_blank">{{ $settings->facebook_url }}</a></p>
                    <p><strong>Instagram:</strong> <a href="{{ $settings->instagram_url }}"
                            target="_blank">{{ $settings->instagram_url }}</a></p>
                    <p><strong>Twitter:</strong> <a href="{{ $settings->twitter_url }}"
                            target="_blank">{{ $settings->twitter_url }}</a></p>
                    <p><strong>LinkedIn:</strong> <a href="{{ $settings->linkedin_url }}"
                            target="_blank">{{ $settings->linkedin_url }}</a></p>
                    <p><strong>YouTube:</strong> <a href="{{ $settings->youtube_url }}"
                            target="_blank">{{ $settings->youtube_url }}</a></p>
                </div>
            </div>

            <!-- Footer -->
            <div class="tab-panel" id="footer">
                <div class="settings-card">
                    <h2>Footer</h2>
                    <p>{{ $settings->footer_about ?? '-' }}</p>
                    <img src="{{ $settings->footer_logo ?? 'https://via.placeholder.com/100' }}" alt="Footer Logo"
                        class="footer-logo">
                </div>
            </div>

            <!-- Global / Maintenance -->
            <div class="tab-panel" id="global">
                <div class="settings-card">
                    <h2>Global Settings</h2>
                    <p><strong>Currency:</strong> {{ $settings->default_currency }}</p>
                    <p><strong>Timezone:</strong> {{ $settings->timezone }}</p>
                    <p><strong>Maintenance Mode:</strong> {{ $settings->maintenance_mode ? 'Enabled' : 'Disabled' }}</p>
                    @if($settings->maintenance_mode)
                        <p><strong>Message:</strong> {{ $settings->maintenance_message ?? '-' }}</p>
                    @endif
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

        // Optional: AJAX submission (fetch)
        document.querySelectorAll('.edit-mode').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const data = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: data,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                })
                    .then(res => res.json())
                    .then(response => {
                        if (response.success) {
                            // Update display mode with new values
                            Object.keys(response.data).forEach(key => {
                                const span = form.closest('.settings-card').querySelector(`.display-mode span`);
                                if (span) span.textContent = response.data[key];
                            });
                            toggleEdit(form.querySelector('.save-btn'), true);
                            alert('Settings updated successfully!');
                        } else {
                            alert('Failed to update settings.');
                        }
                    })
                    .catch(err => console.error(err));
            });
        });

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