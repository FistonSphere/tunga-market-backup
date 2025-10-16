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

    <link rel="stylesheet" href="{{ asset('admin/assets/img/icons/mail.svg') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/img/icons/mail.svg') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/img/icons/mail.svg') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/img/icons/mail.svg') }}" />
</head>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('assets/images/logo.png') }}" style="border-radius: 50%; height: 100px;width:100px;object-fit:cover;" alt="img" />
                        </div>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Please login to your account</h4>
                        </div>
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="text" placeholder="Enter your email address" />
                                <img src="{{ asset('admin/assets/img/icons/mail.svg') }}" alt="img" />
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
                            <div class="alreadyuser">
                                <h4>
                                    <a href="forgetpassword.html" class="hover-a">Forgot Password?</a>
                                </h4>
                            </div>
                        </div>
                        <div class="form-login">
                            <button class="btn btn-login" href="index.html" style="border: none;">Sign In</button>
                        </div>
                        <div class="signinform" style="text-align: center">
                            <h4>
                                Don’t have an account?
                                <a href="signup.html" class="hover-a">Sign Up</a>
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
</body>

</html>