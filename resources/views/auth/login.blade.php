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
        html,
        body {
            height: 100%;
            margin: 0;
        }

        /* Tambahkan gambar background dengan tipe stretch */
        body {
            background-image: url("img/bg4.png");
            content: "";
            background-size: cover;
            /* Tetap gunakan cover untuk memastikan gambar memenuhi layar */
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            /* Pastikan gambar berada di belakang konten lain */
        }

        .login-box,
        .register-box {
            width: auto;
            height: 300px;
        }
    </style>
</head>



<body class="hold-transition login-page">
   
    <div id="error_layout" style="color:red; display: none" class="alert  m-t-20 " role="alert">
        {!! implode('<br>', $errors->all()) !!}
    </div>
    <div class="login-box">
        <form method="POST" id="#recaptcha-form" action="{{ route('login.action') }}">
            @csrf
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <div class="row">
                        <div class="col-md-2">
                           <img width="80px" class="p-2" src="{{ asset('img/lemdiklat_logo.png') }}">
                        </div>
                        <div class="col-md-8">
                            <a style="font-family: my-font; font-size: 46px; letter-spacing: 3px"
                                class="h1"><b>SAMPEYAN</b></a>
                            {{-- <p>Sirelaku</p> --}}
                            <p style="font-size: 18px;" class="login-box-msg">Sistem Administrasi Pelayanan Pasien</p>
                        </div>
                        <div class="col-md-2">
                           <img width="80px" class="p-2" src="{{ asset('img/logo_polda_jambi.png') }}">
                        </div>
                    </div>
                </div>

                {{-- 
                <div style="background-color: #c2e8fb" class="card-header text-center">
                    <a href="#" class="h1"><b>SAMPEYAN</a>
                </div> --}}

                <div class="card">
                    <div class="card-body login-card-body">
                        <div class="input-group mb-3">
                            <input spellcheck="false" id="username" name="username" class="form-control"
                                placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-alt"></span>
                                </div>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group mb-3">


                        </div>
                        <div class="input-group mb-3">
                            <input spellcheck="false" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> --}}


                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                            </div>
                            <!-- /.col -->

                        </div>


                      


                    </div>
                    <div class="card-footer">
                     <div class="text-center mt-4">
                        <div class="logo d-inline-block">
                           <img width="30px" height="30px"  class="" src="{{ asset('img/logo_kedokteran_dan_kesehatan.png') }}">
                        </div>
                        <h6 class="d-inline-block">Poliklinik SPN Polda Jambi</h6>
                      </div>
                    </div>

                </div>
            </div>
        </form>
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
