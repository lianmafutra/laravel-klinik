<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SAMPEYAN</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/dist/css/adminlte.min.css') }}">
    <style>
        .login-box,
        .register-box {
            width: 500px;
        }

        body {
            /* background-image: url({{ asset('img/bg_glass.webp') }});
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat; */
        }

        .card-header {
            background-color: #c0d6ff;
        }


        @font-face {
            font-family: "my-font";
            src: url({{ asset('fonts/SHOWG.TTF') }});
        }
    </style>
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline ">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-2">
                        {{-- <img class="profile-user-img img-fluid" src="{{ asset('img/logo_polda_jambi.png') }}"> --}}
                    </div>
                    <div class="col-md-8">
                        <a style="font-size: 46px; letter-spacing: 3px" href="{{ route('login') }}"
                            class="h1"><b>SAMPEYAN</b></a>
                        {{-- <p>Sirelaku</p> --}}
                        <p style="font-size: 18px;" class="login-box-msg">Sistem Administrasi Pelayanan Pasien</p>
                    </div>
                    <div class="col-md-2">
                        {{-- <img class="profile-user-img img-fluid" src="{{ asset('img/logo_polda_inspektorat.png') }}"> --}}
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div id="error_layout" style="color:red; display: none" class="alert  m-t-20 " role="alert">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
                {{-- <p class="login-box-msg">Sign in to start your session</p> --}}
                <form method="POST" id="#recaptcha-form" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input spellcheck="false" id="username" type="text"
                            class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" required autocomplete="username" autofocus
                            placeholder="username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input spellcheck="false" id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                {{-- <h3>Inspektorat Pengawasan Daerah Polda Jambi</h3> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="{{ asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/admin/dist/js/adminlte.js') }}"></script>
    <script>
        @if (!$errors->isEmpty())
            var input = $('#username');
            var len = input.val().length;

            input[0].focus();
            input[0].setSelectionRange(len, len);
            $('#error_layout').fadeIn(600);
            // Tunggu selama 5 detik (5000 milidetik)
            const timer = 5000;

            // Set timer untuk menghilangkan elemen
            setTimeout(function() {

                $('#error_layout').hide();
            }, timer);
        @endif
    </script>
</body>

</html>
