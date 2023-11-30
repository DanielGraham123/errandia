    
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
    <header class="header-3">
    <div class="top-nav sticky-header sticky-header-2">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-block p-0 me-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="iconly-Category icli"></i>
                                </span>
                            </button>
                            <a href="{{ route('business_admin.home') }}" class="web-logo nav-logo">
                                <img src="{{ asset('assets/admin/logo/errandia-logo.png') }}" class="img-fluid blur-up lazyload" alt="Logo">
                            </a>

                            

                            <div class="rightside-menu support-sidemenu">
                                <div class="support-box">
                                    <div class="support-image">
                                        <img src="../assets/images/icon/support.png" class="img-fluid blur-up lazyload"
                                            alt="">
                                    </div>
                                    <div class="support-number">
                                        <h2>(123) 456 7890</h2>
                                        <h4>24/7 Support Center</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->shops->count() > 0)
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="main-nav nav-left-align">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky p-0">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                        
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('business_admin.businesses.index') }}">Businesses</a>
                                            </li>

                                            
                                        
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">Products / Service</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.products.index') }}">Products</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.services.index') }}">Services</a>
                                                    </li>

                                                    
                                                
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="{{ route('business_admin.enquiries.index') }}"
                                                    data-bs-toggle="dropdown">Enquiries</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.errands.index') }}">Errands recieved</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.errands.index') }}">Errands Sent</a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.errands.create') }}">Run Errand</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                            
                                        

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">Feed Back</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.reviews.index') }}">Business reviews</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.reviews.index') }}">Reviews made</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                            
                                            
                                            

                                            <li class="nav-item new-nav-item">
                                                <a class="nav-link" href="{{ route('business_admin.reports.subscription') }}">Subscriptions</a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">Business Following</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">My Followers</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Following</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="rightside-menu">
                                <ul class="option-list-2">
                                    <li>
                                        <a href="j#" class="header-icon search-box search-icon">
                                            <i class="iconly-Search icli"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="header-icon">
                                            <small class="badge-number badge-light">2</small>
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>


                                    <a href="{{ route('public.home') }}" class="user-box">
                                        <span class="header-icon" style="background:#e0f6fe;border:1px solid#113d6b">
                                            <i class="iconly-Home icli"></i>
                                        </span>
                                        <div class="user-name">
                                            <h6 class="text-content">Visit Website</h6>
                                            
                                        </div>
                                    </a>
                                
                            
                                    
                                </ul>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="user-box">
                                        <span class="header-icon" style="background:#4d9eba;border:1px solid#fff">
                                            <i class="iconly-Logout icli"></i>
                                        </span>
                                        <div class="user-name">
                                            <h6 class="text-content">Logout</h6>
                                            
                                        </div>
                                    </button>
                                </form>

                                

                                

                                <a href="#" class="user-box">
                                    <span class="header-icon">
                                        <i class="iconly-Profile icli"></i>
                                    </span>
                                    <div class="user-name">
                                        <h6 class="text-content">My Account</h6>
                                        <h4 class="mt-1">{{ auth()->user()->name ?? "Jennifer V. Watts" }}</h4>
                                    </div>
                                </a>
                                
                                
                                

                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="main-nav nav-left-align">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky p-0">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                        
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('business_admin.businesses.index') }}">Businesses</a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="{{ route('business_admin.enquiries.index') }}"
                                                    data-bs-toggle="dropdown">Enquiries</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.errands.index') }}">Errands Sent</a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.errands.create') }}">Run Errand</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                            
                                        

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">Feed Back</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('business_admin.reviews.index') }}">Reviews made</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">Business Following</a>
                                                    
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">Following</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="rightside-menu">
                                <ul class="option-list-2">
                                    <li>
                                        <a href="j#" class="header-icon search-box search-icon">
                                            <i class="iconly-Search icli"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="header-icon">
                                            <small class="badge-number badge-light">2</small>
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>


                                    <a href="{{ route('public.home') }}" class="user-box">
                                        <span class="header-icon" style="background:#e0f6fe;border:1px solid#113d6b">
                                            <i class="iconly-Home icli"></i>
                                        </span>
                                        <div class="user-name">
                                            <h6 class="text-content">Visit Website</h6>
                                            
                                        </div>
                                    </a>
                                
                            
                                    
                                </ul>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="user-box">
                                        <span class="header-icon" style="background:#4d9eba;border:1px solid#fff">
                                            <i class="iconly-Logout icli"></i>
                                        </span>
                                        <div class="user-name">
                                            <h6 class="text-content">Logout</h6>
                                            
                                        </div>
                                    </button>
                                </form>

                                

                                

                                <a href="#" class="user-box">
                                    <span class="header-icon">
                                        <i class="iconly-Profile icli"></i>
                                    </span>
                                    <div class="user-name">
                                        <h6 class="text-content">My Account</h6>
                                        <h4 class="mt-1">{{ auth()->user()->name ?? "Jennifer V. Watts" }}</h4>
                                    </div>
                                </a>
                                
                                
                                

                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @endif
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
                <a href="{{ route('business_admin.businesses.index') }}">
                    <i class="iconly-Category  icli js-link"></i>
                    <span>Businesses</span>
                </a>
            </li>

            <li>
                <a href="{{ route('business_admin.products.index') }}" class="search-box">
                    <i class="iconly-Bag-2 icli js-link"></i>
                    <span>Products</span>
                </a>
            </li>

            <li>
                <a href="{{ route('business_admin.services.index') }}" class="search-box">
                    <i class="iconly-Swap icli js-link"></i>
                    <span>Services</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- mobile fix menu end -->
