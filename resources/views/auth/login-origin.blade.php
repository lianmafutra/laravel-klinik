<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon"
    href="{{ asset('img/' . Cache::store('styles')->get('fav_icon', 'img/logo_laravel.jpeg')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/hamburgers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/animsition.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/utils.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/login2/css/main.css') }}">
    <script src="{{ asset('template/login2/js/jquery-3.2.1.js') }}"></script>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-85 p-b-20">
                <form autocomplete="false" method="POST" id="#recaptcha-form" action="{{ route('login.action') }}">
                    @csrf
                    <span class="login100-form-title p-b-70">
                        Welcome
                    </span>
                    <span class="login100-form-avatar">
                        <img src="{{ asset('img/logo_laravel.jpeg') }}" alt="AVATAR">
                    </span>
                    <div id="error_layout" style="display: none" class="alert alert-danger m-t-20 " role="alert">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                    <div class="wrap-input100 validate-input m-t-80 m-b-35" data-validate="Enter username">
                        <input spellcheck="false" id="username" class="input100" type="text" name="username"
                            value="{{ old('username') }}" required>
                        <span class="focus-input100" data-placeholder="Username"></span>
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                        <input spellcheck="false" class="input100" type="password" name="password" required>
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="container-login100-form-btn">
                        <button id="submit" type="submit" class="login100-form-btn">{{ __('Login') }}</button>
                    </div>
                </form>
                <ul class="login-more p-t-190">
                    <li class="m-b-8">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a href="#" class="txt2">
                            Username / Password?
                        </a>
                    </li>
                    <li>
                        <span class="txt1">
                            Don't have an account?
                        </span>
                        <a href="#" class="txt2">
                            Sign up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/login2/js/animsition.js') }}"></script>
    <script src="{{ asset('template/login2/js/popper.js') }}"></script>
    <script src="{{ asset('template/login2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/login2/js/main.js') }}"></script>
    <script>
        @if (!$errors->isEmpty())
            var input =  $('#username');
            var len = input.val().length;
            input[0].focus();
            input[0].setSelectionRange(len, len);
            $('#error_layout').fadeIn(600);
        @endif
    </script>
</body>
</html>