<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('assets/images/logo-transparent.png')}}"> Jersey Swap
        </a>
        @auth()
            @if(auth()->user()->role->role=="user")
                <a class="nav-link notification d-md-none d-sm-block text-dark" href="{{url('notifications')}}">
                    <i class="fas fa-bell"></i>
                        @if(auth()->user()->unReadNotifications->count()>0)
                            <span class="notifications">{{auth()->user()->unReadNotifications->count()}}</>
                        @endif
                </a>
            @endif
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='/') active @endif" aria-current="page" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='exchange') active @endif" href="{{route('exchange')}}">Exchange</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='listings/add-listing') active @endif" href="{{url('listings/add-listing')}}">Create Listing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='messages') active @endif" href="{{url('messages')}}">Message</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='about') active @endif" href="{{url('about')}}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='contact') active @endif" href="{{url('contact')}}">Contact</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link @if(Request::path()=='login') active @endif" href="{{url('login')}}">Log In</a>
                </li>
                @endguest
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(auth()->user()->role->role=="admin")
                        <li>
                            <a class="dropdown-item" href="{{url('admin/dashboard')}}">Dashboard</a>
                        </li>
                        @else
                        <li>
                            <a class="dropdown-item" href="{{url('users/cawoy/dashboard')}}">Dashboard</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{url('users/settings/account')}}">Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{url('/users/listings')}}">Listings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{url('offers')}}">Active Offers</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{url('trading')}}">Transactions</a>
                        </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->role->role=="user")
                <li class="nav-item d-none d-sm-none d-md-block">
                    <a class="nav-link notification" href="{{url('notifications')}}">
                        <i class="fas fa-bell"></i>
                        @if(auth()->user()->unReadNotifications->count()>0)
                            <span class="notifications">{{auth()->user()->unReadNotifications->count()}}</>
                        @endif
                    </a>
                </li>
                @endif
                @endauth
            </ul>
            @guest
            <div class="d-flex">
                <a class="btn btn-primary ms-2 me-2" href="{{route('exchange')}}">Start Trading Now</a>
                <a class="btn btn-primary" href="{{route('register')}}">Sign up</a>
            </div>
            @endguest
        </div>
    </div>
    </div>
</nav>
<!-- .End Navbar-->
