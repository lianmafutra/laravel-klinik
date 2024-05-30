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



    </style>
</head>



<body class="hold-transition login-page">
    <div id="error_layout" style="color:red; display: none" class="alert  m-t-20 " role="alert">
        {!! implode('<br>', $errors->all()) !!}
    </div>
    <div class="login-box">
        <form method="POST" id="#recaptcha-form" action="{{ route('login') }}">
            @csrf
            <div class="card card-outline card-primary">
                <div style="background-color: #c2e8fb" class="card-header text-center">
                    <a href="#" class="h1"><b>SAMPYEAN</a>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Sistem Administrasi Pelayanan Pasien</p>
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
