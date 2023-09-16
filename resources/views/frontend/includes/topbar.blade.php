<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0">
        <div class="header-container container-fluid px-lg-4">
            <div class="header-row">
                <div class="header-column header-column-border-right flex-grow-0">
                    <div class="header-row pr-4">
                        <div class="header-logo">
                            <a href="index.html">
                                <img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="{{ asset('frontend/img/Simple.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-nav header-nav-links justify-content-center">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse header-mobile-border-top">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="{{ route('homepage') }}">
                                                Home
                                            </a>
                                            {{-- <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="index.html">
                                                        Landing Page
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index.html#demos">
                                                        Demos
                                                    </a>
                                                </li>
                                            </ul> --}}
                                        </li>

                                        @foreach ( App\Models\Category::orderBy('name', 'asc')->where('is_parent', 0)->where('status', 1)->get() as $pCategory)
                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="{{ route('blogpage', $pCategory->id) }}">
                                                    {{ $pCategory->name }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @foreach ( App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCategory->id)->where('status', 1)->get() as $childCategory)
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('blogpage', $childCategory->id) }}">
                                                                {{ $childCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach

                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="{{ route('contact') }}">
                                                Contact Us
                                            </a>
                                        </li>

                                        @if ( Auth::check() )
                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="{{ route('userLogin') }}">
                                                    {{-- Image --}}
                                                    {{-- @if ( !is_null( Auth::user()->image ) )
                                                        <img src="{{ asset('images/user/' . Auth::user()->image ) }}" width="25" style="border-radius: 50%" alt="Avater">
                                                    @else
                                                        <img src="{{ asset('images/user/default.jpg' ) }}" class="user-img" alt="user avatar">
                                                    @endif --}}
                                                    <i class="far fa-user"></i> &nbsp;
                                                    {{ Auth::user()->name }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ route('customerDashboard') }}">My Dashboard</a></li>
                                                    {{-- <li><a class="dropdown-item" href="{{ route('userLogin') }}">Login</a></li> --}}
                                                    <li>
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                <i class='bx bx-log-out-circle'></i>
                                                                <span>Logout</span>
                                                            </a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>

                                        @else
                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="{{ route('userLogin') }}">
                                                    Signin | Signup
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-column header-column-border-left flex-grow-0 justify-content-center">
                    <div class="header-row pl-4 justify-content-end">
                        <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean m-0">
                            <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                        <button class="btn header-btn-collapse-nav ml-0 ml-sm-3" data-toggle="collapse" data-target=".header-nav-main nav">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
