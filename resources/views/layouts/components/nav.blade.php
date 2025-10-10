<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container {{ Request::is('penilaian/rpts') || Request::is('penilaian/rapor/rerata') || Request::is('sarpras') || Request::is('sarpras/dorm-purchase') || Request::is('sarpras/damaged-items-dorm') || Request::is('sarpras/good-items-dorm') || Request::is('sarpras/school-purchase') || Request::is('sarpras/damaged-items-school') || Request::is('sarpras/good-items-school') ? 'custom-container' : (Request::is('penilaian/rapor') || Request::is('penilaian/panitia') ? 'xl-custom-container' : '') }}">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="https://res.cloudinary.com/dhyq9uts4/image/upload/v1676360444/logo_v09np1.png" alt="Logo"
                class="img-fluid h-6 w-auto">
        </a>
        <!-- Burger button for collapsing navbar -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side of Navbar -->

            <!-- Right Side of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a href="/progres-siswa" class="text-black nav-item {{ Request::is('progres-siswa') ? 'hidden' : '' }}">Klik Progres Kemajuan Peserta Didik</a>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
