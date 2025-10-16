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
    <title>Sign Up - Tunga Market Admin Dashboard</title>

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
                            <h3>Create an Account</h3>
                            <h4>Continue where you left off</h4>
                        </div>
                        <form class="space-y-4" id="registerForm" method="POST">
                            @csrf
                            <div class="form-login">
                                <label>First Name</label>
                                <div class="form-addons">
                                    <input type="text" class="input-field" placeholder="First Name" name="first_name"
                                        required />
                                    <img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="img" />
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Last Name</label>
                                <div class="form-addons">
                                    <input type="text" class="input-field" placeholder="Last Name" name="last_name"
                                        required />
                                    <img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="img" />
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="email" class="input-field" placeholder="Email" name="email" required />
                                    <img src="{{ asset('admin/assets/img/icons/mail.svg') }}" alt="img" />
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Phone</label>
                                <div class="form-addons">
                                    <input type="text" class="input-field" placeholder="(e.g., +25078XXXXXXX)"
                                        name="phone" required />
                                    <img src="{{ asset('admin/assets/img/icons/phone.svg') }}" style="width:13px; height: 13px; color:#6d7d8b" alt="img" />
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" placeholder="Enter your password" />
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" placeholder="Enter your password" />
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <p id="passwordMatchMessage" class="text-xs mt-2 hidden" style="color:rgb(189, 6, 6)">Passwords do not
                                match.</p>
                            <div class="form-login">
                                <a class="btn btn-login">Sign Up</a>
                            </div>

                        </form>
                        <div class="signinform text-center">
                            <h4>
                                Already a user?
                                <a href="{{ route('admin.login') }}" class="hover-a">Sign In</a>
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