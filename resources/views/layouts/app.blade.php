<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title') </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- Font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="app" class="bg-white min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light border-bottom">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto my-3 my-md-0">
                        @if (Auth::user())
                            <li class="nav-item w-100 w-md-auto">
                                <form action="{{ route('search') }}">
                                    <input type="search" name="search" id="search" placeholder="Search product" class="input-search form-control form-control-md" style="min-width: 280px;">
                                </form>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            {{-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle align-items-center d-none d-md-flex" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="avatar avatar-sm me-2">
                                        @include('components.user-avatar', ['user' => Auth::user()])
                                    </div>
                                    {{ Auth::user()->name }}
                                </a>

                                <!-- Dropdown for Desktop -->
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('profile.show', Auth::user()->id) }}">My Account<i class="fa-solid fa-chevron-right small"></i></a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('profile.purchases', Auth::user()->id) }}">My Purchases<i class="fa-solid fa-chevron-right small"></i></a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('profile.sales', Auth::user()->id) }}">My Sales<i class="fa-solid fa-chevron-right small"></i></a>
                                    <a href="{{ route('profile.followers', Auth::user()->id) }}" class="dropdown-item d-flex justify-content-between align-items-center">Followers<i class="fa-solid fa-chevron-right small"></i></a> 
                                    <a href="{{ route('profile.following', Auth::user()->id) }}" class="dropdown-item d-flex justify-content-between align-items-center">Following<i class="fa-solid fa-chevron-right small"></i></a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        <i class="fa-solid fa-right-from-bracket small"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                <!-- / Dropdown for Desktop -->
                            </li>
                            <!-- Navlinks for Mobile -->
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item d-flex justify-content-between align-items-center py-2" href="{{ route('profile.show', Auth::user()->id) }}">My Account</a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item d-flex justify-content-between align-items-center py-2" href="#">My Purchases</a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item d-flex justify-content-between align-items-center py-2" href="#">My Sales</a>
                            </li>
                            <!-- / Navlinks for Mobile -->
                            <li class="nav-item">
                                <a href="{{ route('profile.favorite', Auth::user()->id) }}" class="text-dark text-decoration-none d-block py-2 py-md-0">
                                    <i class="fa-regular fa-heart mx-2 fs-4 align-bottom d-none d-md-block"></i>
                                    <span class="d-md-none">My Favorites</span>
                                </a>
                            </li>
                            
                            <li class="nav-item position-relative pe-2">
                                @if (Auth::user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-danger position-absolute rounded-circle">{{ Auth::user()->unreadNotifications->count() }}</span>
                                @endif
                                <a href="{{ route('notification', Auth::user()->id) }}" class="text-dark text-decoration-none d-block py-2 py-md-0">
                                    <i class="fa-regular fa-bell ms-2 fs-4 align-bottom d-none d-md-block"></i>
                                    <span class="d-md-none">Notifications</span>
                                </a>
                            </li>

                            <li class="nav-item position-relative pe-3">
                                @if (Auth::user()->cartItems->count() > 0)
                                    <span class="badge bg-danger position-absolute rounded-circle">{{ Auth::user()->cartItems->count() }}</span>
                                @endif
                                <a href="{{ route('cart') }}" class="text-dark text-decoration-none d-block py-2 py-md-0">
                                    <i class="fa-solid fa-cart-shopping ms-2 fs-4 align-bottom d-none d-md-block"></i>
                                    <span class="d-md-none">Cart</span>
                                </a>
                            </li>

                            <li class="nav-item ms-2">
                                <a href="{{ route('product.create') }}" class="btn btn-primary d-none d-md-block">Sell</a>
                                <a href="{{ route('product.create') }}" class="text-dark text-decoration-none d-block d-md-none py-2">Sell</a>
                            </li>
                            <!-- Logout for Mobile -->
                            <li class="nav-item d-md-none">
                                <a class="py-2 d-block text-decoration-none text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <!-- Logout for Mobile -->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="mt-4 py-4">
            <div class="container">
                <div class="row flex-row-reverse justify-content-center">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}
</body>
</html>
