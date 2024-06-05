<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('login-theme/style1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login-theme/style1/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login-theme/style1/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login-theme/style1/css/iofrm-theme9.css') }}">

</head>
<style>
    .login {
        font-size: 20px !important;
        font-weight: 600px;
    }

    .website-logo-inside img {
        width: 350px !important;
    }

    .website-logo-inside {
        margin-bottom: 0px !important;
    }

    .form-content .page-links {
        margin-bottom: 34px!important;
        margin-top: 40px!important;
    }
</style>

<body>
    @php
        if (!$errors->isEmpty()) {
            alert()
                ->error('Pemberitahuan', implode('<br>', $errors->all()))
                ->toToast()
                ->toHtml();
        }
    @endphp
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Get more things done with Loggin platform.</h3>
                    <p>Access to the most powerfull tool in the entire design and web industry.</p>
                    <img src="{{ asset('img/logo_text.png') }}" alt="">
                </div>
            </div>
            <div class="form-holder">

                <div class="form-content">

                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="">
                                <div class="logo_custom">
                                    {{-- <img class="logo-size" src="{{ asset('img/logo_app_kinerja.png') }}" alt=""> --}}
                                </div>
                            </a>
                        </div>
                        <p style="padding-left: 5px">( Sistem Informasi Uji Cermat Pengawasan )</p>
                        <div class="page-links">
                            <a href="login9.html" class="active">Login Akun</a>
                        </div>
                        <form autocomplete="false" method="POST" id="#recaptcha-form" action="{{ route('login.action') }}">
                            @csrf
                            <input class="login form-control" type="text" name="username" placeholder="Username"
                                required>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="login form-control" type="password" name="password" placeholder="Password"
                                required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">{{ __('Login') }}</button> 
                            </div>
                        </form>
                        <div class="other-links">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
    </div>
    <script src="{{ asset('login-theme/style1/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login-theme/style1/js/popper.min.js') }}"></script>
    <script src="{{ asset('login-theme/style1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-theme/style1/js/main.js') }}"></script>

</body>

</html>
