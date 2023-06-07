<header class="header clearfix element_to_stick">
<div class="container">
    <div class="layer"></div>
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset($general ? $general->logo:'') }}" width="60" height="60" alt="" class="logo_normal">
                <img src="{{ asset($general ? $general->logo:'') }}" width="60" height="60" alt="" class="logo_sticky">
            </a>
        </div>
     
        <!-- /top_menu -->
        <a href="#" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close warna"></i><span>Menu</span>
                </a>
                <a href="index.html"><img src="{{ asset($general ? $general->logo:'') }}" width="140" alt=""></a>
            </div>
            <ul>
                <!-- <li class="submenu">
                    <a href="{{ route('home') }}" class="show-submenu">Home</a>
                </li> -->
                <li class="submenu">
                    <a href="{{ route('about') }}" class="show-submenu">About Us</a>
                </li>
                <li class="submenu">
                    <a href="{{ route('menu') }}" class="show-submenu">Food Menu</a>
                </li>
                <li class="submenu">
                    <a href="#" class="show-submenu">Gallery</a>
                    <ul>
                        <li><a href="{{ route('gallery', 'photo') }}">Photo Gallery</a></li>
                        <li><a href="{{ route('gallery', 'video') }}">Video Gallery</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="{{ route('allblogs') }}" class="show-submenu">Blog</a>
                </li>
                <li class="submenu">
                    <a href="{{ route('contact') }}" class="show-submenu">Contact Us</a>
                </li>
                @guest
                <!-- <li><a href="javascript:void(0)" class="btn_top" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</a></li>
                <li><a href="javascript:void(0)" class="btn_top" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li> -->
                @else
                <li>
                    <a class="btn_top" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
    <!-- Search -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_search"></i></button>
        </form>
    </div><!-- End Search -->
    </div>
</header>
