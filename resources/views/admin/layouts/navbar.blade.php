<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('user.profile') }}" class="nav-link">
                <span style="font-weight: 900"> {{ auth()->user()->name }} </span>
                <span class="pl-1" style="color: rgb(137, 137, 137)"> </span>
            </a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link d-none d-sm-inline-block" id="btntheme" role="button">
                {{-- <i id="icontheme" class="fas fa-sun"></i> --}}
                {{ \Carbon\Carbon::now()->translatedFormat('l, d-F-Y') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="" target="_bkank" role="button">
                <i class="fas fa-globe"></i>
            </a>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img onerror="this.onerror=null; this.src='{{ asset('img/avatar.png') }}'" style="object-fit: cover"
                    src="{{ $fotoProfil }}" class="user-image img-circle elevation-2" alt="User Image">
                {{-- <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                {{-- <span 
                    class="dropdown-item dropdown-header">
                    <span  class="d-none d-md-inline">{{ Auth::user()->name }}</span></span>
                <div class="dropdown-divider"></div> --}}
                {{-- <span class="dropdown-item dropdown-header">15 Notifications</span> --}}
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.profile') }}" class="dropdown-item">
                    <i class="fas fa-user-alt mr-2"></i>Profile
                </a>
                <div class="dropdown-divider"></div>
                <a data-toggle="modal" data-target="#modal-logout" data-backdrop="static" data-keyboard="false"
                    style="padding-bottom: 15px" href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt  mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
