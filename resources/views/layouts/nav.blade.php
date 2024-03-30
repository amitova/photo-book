<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="fw-bold fs-3">Phot</span> <i class="fa-solid fa-camera text-success fw-bold fs-3 me-3"> </i><span class="fw-bold fs-3">Book</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <ul class="navbar-nav ms-5 me-5">
                        <li class="nav-item">
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold text-dark  @if (request()->is('/'))  border-bottom border-success @endif " href="/">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  fs-5 fw-bold text-dark @if (request()->is('photos'))  border-bottom border-success @endif" href="{{ route('photos')}}">{{ __('Photos') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  fs-5 fw-bold text-dark @if (request()->is('showUsers'))  border-bottom border-success @endif " href="{{ route('showUsers')}}">{{ __('Users') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  fs-5 fw-bold text-dark @if (request()->is('contact'))  border-bottom border-success @endif " href="{{ route('contactUs')}}">{{ __('Contacts') }}</a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item @if (request()->is('addPhotos')) text-success fw-bold  @endif" href="{{ route('addPhotos') }}">{{ __('Add Photos') }}</a>
                                    <a class="dropdown-item @if (request()->is('showUserProfile')) text-success fw-bold  @endif" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                    @if(Auth::user()->role=='admin')
                                        <a class="dropdown-item @if (request()->is('statistics')) text-success fw-bold  @endif" href="{{ route('statistics') }}">{{ __('Statistics') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
