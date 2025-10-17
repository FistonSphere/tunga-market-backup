<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description"
        content="Manage your marketplace smarter with Tunga Market Admin — intuitive analytics, real-time insights, and full control over your digital ecosystem." />

    <meta name="keywords"
        content="Tunga Market, admin panel, commerce automation, digital trading, backend management, data insights, online market control, platform administration, ecommerce intelligence" />

    <meta name="author" content="Tunga Market - Admin Dashboard" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Login - Tunga Market Admin Dashboard</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}" />

    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}" />
</head>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('assets/images/logo.png') }}"
                                style="border-radius: 50%; height: 100px;width:100px;object-fit:cover;" alt="img" />
                        </div>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Please login to your admin account</h4>
                        </div>
                        {{-- Inline-styled Error Messages --}}
                        @if ($errors->any())
                            <div id="alert-errors" role="alert"
                                style="background:#fff6f6;border:1px solid #f5c2c7;color:#842029;padding:14px;border-radius:8px;margin-bottom:16px;">
                                <strong style="display:block;font-weight:700;margin-bottom:6px;">Whoops! Something went
                                    wrong:</strong>
                                <ul style="margin:0;padding-left:18px;">
                                    @foreach ($errors->all() as $error)
                                        <li style="margin-bottom:4px;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Inline-styled Success Message (auto-hide) --}}
                        @if (session('success'))
                            <div id="alert-success" role="status"
                                style="background:#ecfdf5;border:1px solid #bbf7d0;color:#065f46;padding:14px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;">
                                <div style="flex:1;">
                                    <strong style="display:block;font-weight:700;margin-bottom:6px;">Success</strong>
                                    <span>{{ session('success') }}</span>
                                </div>

                                <!-- Close button (optional) -->
                                <button type="button"
                                    onclick="document.getElementById('alert-success').style.display='none';"
                                    aria-label="Close"
                                    style="margin-left:12px;background:transparent;border:0;color:#065f46;font-weight:700;cursor:pointer;">
                                    ×
                                </button>
                            </div>

                            <script>
                                // Auto-hide success message after 4 seconds
                                (function () {
                                    var el = document.getElementById('alert-success');
                                    var el2 = document.getElementById('alert-errors');
                                    if (!el) return;
                                    if (!el2) return;
                                    setTimeout(function () {
                                        // smooth fade out
                                        el.style.transition = 'opacity 400ms ease, transform 400ms ease';
                                        el.style.opacity = '0';
                                        el.style.transform = 'translateY(-6px)';
                                        el2.style.transition = 'opacity 400ms ease, transform 400ms ease';
                                        el2.style.opacity = '0';
                                        el2.style.transform = 'translateY(-6px)';
                                        setTimeout(function () { el.style.display = 'none'; }, 450);
                                        setTimeout(function () { el2.style.display = 'none'; }, 450);
                                    }, 4000);
                                })();
                            </script>
                        @endif
                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your email address" name="email" />
                                    <img src="{{ asset('admin/assets/img/icons/mail.svg') }}" alt="img" />
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input"
                                        placeholder="Enter your password" />
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <div class="alreadyuser">
                                    <h4>
                                        <a href="#" class="hover-a">Forgot Password?</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login" style="border: none;">Sign In</button>
                            </div>
                        </form>

                        <div class="signinform" style="text-align: center">
                            <h4>
                                Don’t have an account?
                                <a href="{{ route('admin.register') }}" class="hover-a">Sign Up</a>
                            </h4>
                        </div>
                        <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('admin/assets/img/icons/google.png') }}" class="me-2"
                                            alt="google" />
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('admin/assets/img/icons/facebook.png') }}" class="me-2"
                                            alt="google" />
                                        Sign Up using Facebook
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ asset('admin/assets/img/login.jpg') }}" alt="img" />
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/script.js') }}"></script>


</body>

</html>