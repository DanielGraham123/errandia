    
    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    
    <!-- Header Start -->
    <header class="pb-md-4 pb-0">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <i class="iconly-Location icli text-white"></i>
                            <span class="text-white"><?php echo  date('l- d-m-Y'); ?></span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">
                                <div>
                                    <div class="timer-notification">
                                        <h6><strong class="me-1">Please beware of scammers. Do not transfer money to anyone without seeing and or testing the product/Service
                                            </strong>

                                        </h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-language"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/public/assets/images/country/united-kingdom.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <span>English</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="select-language">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="english">
                                                <img src="{{ asset('assets/public/assets/images/country/united-kingdom.png') }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="france">
                                                <img src="{{ asset('assets/public/assets/images/country/French.png') }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>French</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-dollar"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>USD</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end sm-dropdown-menu"
                                        aria-labelledby="select-dollar">
                                        <li>
                                            <a class="dropdown-item" id="aud" href="javascript:void(0)">AUD</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="eur" href="javascript:void(0)">EUR</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="cny" href="javascript:void(0)">CNY</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="{{ route('public.home') }}" class="web-logo nav-logo">
                                <img src="{{ asset('assets/admin/logo/errandia-logo.png') }}" class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="middle-box">
                                <div class="location-box">
                                    <button class="btn location-button" data-bs-toggle="modal"
                                        data-bs-target="#locationModal">
                                        <span class="location-arrow">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                        <span class="locat-name">Your Location</span>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                </div>
                                <form method="get" action="{{ route('public.search') }}">
                                    <div class="search-box">
                                        <div class="input-group">
                                            <input type="search" data-announce="true" data-max-words="3" class="form-control" placeholder="Product name only (Maximum 3 words)..." value="{{ $search_string??'' }}"
                                                aria-label="Recipient's username" aria-describedby="button-addon2" name="searchString" required>
                                            <button class="btn" type="submit" id="button-addon2" style="background:#113d6b" onclick="runSearch()">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type" placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="contact-us.html" class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="phone-call"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>24/7 Availability</h6>
                                                <h5>+237 68895055</h5>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li class="right-side onhover-dropdown">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Hello,</h6>
                                                <h5>{{ auth()->check() ? auth()->user()->name : auth('admin')->user()->name ?? "User Account" }}</h5>
                                            </div>
                                        </div>

                                        <div class="onhover-div onhover-div-login lh-2">
                                            <ul class="user-box-name ">
                                                @if (auth()->check() || auth('admin')->check())
                                                    <li class="product-box-contain">
                                                        <i></i>
                                                        <a href="{{ route('logout') }}">Log Out</a>
                                                    </li>   
                                                @else
                                                    <li class="product-box-contain">
                                                        <i></i>
                                                        <a href="{{ route('login') }}">Log In</a>
                                                    </li>
                                                @endif

                                                <li class="product-box-contain">
                                                    <a href="{{ route('register') }}">Register</a>
                                                </li>
                                                @if (auth()->check() || auth('admin')->check())
                                                    <li class="product-box-contain">
                                                        <a href="@if(auth()->check()) {{ route('business_admin.home') }} @else {{ route('admin.home') }} @endif">My Dashboard</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category">
                                <i data-feather="align-left"></i>
                                <span>All Categories</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>Categories</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <ul class="category-list">
                                    @foreach (\App\Models\Category::inRandomOrder()->get() as $category)
                                        <li class="onhover-category-list">
                                            <a href="#" class="category-name">
                                                <img src=" {{ asset('assets/admin/icons/'.$category->image_path.'.svg') }}" alt="">
                                                <h6>{{ $category->name }}</h6>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>

                                            <div class="onhover-category-box">
                                                <div class="list-1">
                                                    <ul>
                                                        @foreach ($category->sub_categories as $subcat)
                                                            <li>
                                                                <a href="#">{{ $subcat->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            <li class="nav-item ">
                                                <a class="nav-link " href="{{ route('public.errands') }}">Errands</a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Businesses</a>

                                                <ul class="dropdown-menu">
                                                    @foreach (\App\Models\Region::orderBy('name')->get() as $region)
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('public.businesses', $region->id) }}">{{ $region->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('public.errands.run') }}">Run an Errand </a>
                                            </li>
                                           </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="{{ route('public.home') }}">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="{{ route('public.search') }}" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="{{ route('public.errands.run') }}" class="notifi-wishlist">
                    <i class="iconly-Search icli"></i>
                    <span>Run Errand</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- mobile fix menu end -->
