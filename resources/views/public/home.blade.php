@extends('public.layout')
@section('section')
    <section class="home-section-2 home-section-bg pt-0 overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="slider-animate">
                        <div>
                            <div class="home-contain rounded-0 p-0 bg-size blur-up lazyloaded" style="background-image: url({{asset('assets/public/assets/images/landing-image/home.png')}}); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                <img src="{{asset('assets/public/assets/images/landing-image/home.png')}}" class="img-fluid bg-img blur-up lazyloaded" alt="" style="display: none;">
                                <div class="home-detail home-big-space home-overlay position-relative" style="background: rgba(90,90,90,0.7);">
                                    <div class="container-fluid-lg">
                                         <header class="pb-md-4 pb-0">
                                            <div class="top-nav top-header">
                                                <div class="container-fluid-lg">
                                                    <div class="container text-center">
                                                        <h3 class="h3 mt-3 text-white">Looking for a specific product? Errandia helps you find exactly what you need.</h3>
                                                        <span class="d-block h5 mb-3 text-white">And let the suppliers Contact you with Proposals</span>
                                                    </div>
                                               
                                                    <div class="container-fluid-lg">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="header-nav">

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
                                                                                        <li class="nav-item">
                                                                                            <b class="nav-link text-white">Top Searches:</b>
                                                                                        </li>

                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link text-white" href="#">Electonics</a>                                                                                           
                                                                                        </li>
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link text-white" href="#">Beauty</a>                                                                                           
                                                                                        </li>
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link text-white" href="#">Music</a>                                                                                           
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
                                                </div>
                                            </div>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Category Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-9">
                        @foreach (\App\Models\Category::all() as $k=>$cat)
                            <div>
                                <a href="{{ route('public.category.show', $cat->slug) }}" class="category-box category-dark wow fadeInUp">
                                    <div>
                                        <img src="{{ asset('assets/admin/icons/'.$cat->image_path.'.svg') }}" class="blur-up lazyload" alt="">
                                        <h5>{{ $cat->name }}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End -->



    <!-- Featured Businesses Section Start -->
    <section class="product-section product-section-3">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Feature Businesses</h2>
            </div>
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 ratio_110">
                    <div class="slider-6 img-slider">
                        
                        @foreach (\App\Models\Shop::inRandomOrder()->take(16)->get() as $k=>$shop)
                         
                        <div>
                            <div class="product-box-5 wow fadeInUp">
                                <div class="product-image">
                                    <a href="{{ route('public.business.show', $shop->slug) }}">
                                        <img src="{{ asset('uploads/logos/'.$shop->image_path) }}"
                                            class="img-fluid blur-up lazyload bg-img" alt="">
                                    </a>

                                </div>

                                <div class="product-detail">
                                    <a href="{{ route('public.business.show', $shop->slug) }}">
                                        <h5 class="name">{{ $shop->name }}</h5>
                                    </a>
                                 
                                </div>
                            </div>
                        </div>
                        @endforeach
                       


                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Businesses Section End -->


    <!-- banner section start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row g-md-4 g-3">
                <div class="col-xxl-8 col-xl-12 col-md-7">
                    <div class="banner-contain hover-effect">
                        <img src="../assets/images/fashion/banner/1.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details p-center-left p-4">
                            <div>
                                <h2 class="text-kaushan fw-normal theme-color">Seat at Home</h2>
                                <h3 class="mt-2 mb-3">& Relaxe!</h3>
                                <p class="text-content banner-text">Having trouble searching for products or services? Errandia offers you a perfect platform
                                     for efficiently running errands and finding what you need. Save time and stress with these helpful suggestions.</p>
                                <button onclick="location.href = 'shop-left-sidebar.html';"
                                    class="btn btn-animation btn-sm mend-auto">Search Now <i
                                        class="fa-solid fa-arrow-right icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-12 col-md-5">
                    <a href="shop-left-sidebar.html" class="banner-contain hover-effect h-100">
                        <img src="../assets/images/fashion/banner/2.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details p-center-left p-4 h-100">
                            <div>
                                <h2 class="text-kaushan fw-normal text-danger">20% Off</h2>
                                <h3 class="mt-2 mb-2 theme-color">SUMMRY</h3>
                                <h3 class="fw-normal product-name text-title">Product</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section end -->


    <!-- Top Selling Section Start -->
    <section class="top-selling-section">
        <div class="container-fluid-lg">
            <div class="row">            
                <div class="col-xxl-3 col-lg-4 d-lg-block d-none">
                    <div class="ratio_156">
                        <div class="banner-contain-2 hover-effect">
                            <img src="{{ asset('assets/images/default1.jpg') }}" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-detail-2 p-bottom-center text-center home-p-medium">
                                <div>
                                    <h2 class="text-qwitcher">Stay at Home</h2>
                                    <h4>and let Errandia do the search</h4>
                                    <button onclick="location.href = 'shop-left-sidebar.html';" class="btn btn-md">Register Today <i class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <span>Top Search by Town</span>
                        </button>
                    </h2>
                    <ul class="category-list custom-padding custom-height">
                        @foreach (\App\Models\Town::take(15)->get() as $town)
                            <li>
                                <div class="form-check ps-0 m-0 category-list-box">
                                    <input class="checkbox_animated" type="checkbox" id="fruit">
                                    <label class="form-check-label" for="fruit">
                                        <span class="name">{{ $town->name }}</span>
                                        <span class="number">(15)</span>
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <div class="slider-3_3 product-wrapper">
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="top-selling-box">
                                        <div class="top-selling-title">
                                            <h3>Recently Posted Errands</h3>
                                        </div>
                                        @for($i = 0; $i < 6; $i++)
                                            <div class="top-selling-contain wow fadeInUp" style="border:1px solid#eee;">
                                                <a href="product-left-thumbnail.html" class="top-selling-image">
                                                    <img src="{{ asset('assets/images/default2.jpeg') }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="top-selling-detail">
                                                    <a href="product-left-thumbnail.html">
                                                        <h5>Tuffets Whole Wheat Bread</h5>
                                                    </a>
                                                    <div class="product-rating">
                                                        <p class="line-clamp-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe veniam consectetur fugit ut recusandae error provident inventore molestias perspiciatis, voluptatibus excepturi voluptas et maiores delectus beatae, vero porro, fugiat ipsum?</p>
                                                    </div>
                                                    <button class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color btn-sm"> Call Customer
                                                    &nbsp;<span class="add-icon bg-light-gray">
                                                            <i class="fa fa-phone"></i>
                                                        </span>
                                                    </button>
                                                </div> 
                                            </div>
                                        @endfor

 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="top-selling-box">
                                        <div class="top-selling-title">
                                            <h3>Trending Services</h3>
                                        </div>

                                        @for($i = 0; $i < 6; $i++)
                                            <div class="top-selling-contain wow fadeInUp" style="border:1px solid#eee;">
                                                <a href="product-left-thumbnail.html" class="top-selling-image">
                                                    <img src="{{ asset('assets/images/default1.jpg') }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="top-selling-detail">
                                                    <a href="product-left-thumbnail.html">
                                                        <h5>service name</h5>
                                                    </a>
                                                        <span>Business Name<br>
                                                        Location</span>
                                                    
                                                    <h6>1000</h6>
                                                </div>    
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="top-selling-box">
                                        <div class="top-selling-title">
                                            <h3>Trending Products</h3>
                                        </div>

                                        @for($i = 0; $i < 6; $i++)
                                            <div class="top-selling-contain wow fadeInUp" style="border:1px solid#eee;">
                                                <a href="product-left-thumbnail.html" class="top-selling-image">
                                                    <img src="{{ asset('assets/images/default1.jpg') }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="top-selling-detail">
                                                    <a href="product-left-thumbnail.html">
                                                        <h5>product name</h5>
                                                    </a>
                                                        <span>Business Name<br>
                                                        Location</span>
                                                    <h6>1000</h6>
                                                </div>         
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Selling Section End -->



    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">


            
            <div class="row">
                <div class="col-custome-3 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="left-box">
                        <div class="shop-left-sidebar">                           
                            
                            <div class="accordion custome-accordion" id="accordionExample">                                                         

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span>Top Searches By Town</span>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <label class="form-check-label" for="veget">
                                                            <span class="name">Vegetarian</span>
                                                            <span class="number">(08)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <label class="form-check-label" for="non">
                                                            <span class="name">Non Vegetarian</span>
                                                            <span class="number">(09)</span>
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <!----banner on sidebar---->
                                        <div class="ratio_156">
                                            <div class="banner-contain-2 hover-effect bg-size blur-up lazyloaded" style="background-image: url(&quot;../assets/images/fashion/banner/3.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                                <img src="{{ asset('assets/images/default1.jpg') }}" class="bg-img blur-up lazyload" alt="" style="display: none;">
                                                <div class="banner-detail-2 p-bottom-center text-center home-p-medium">
                                                    <div>
                                                        <h2 class="text-qwitcher">Stay at Home</h2>
                                                        <h4>and let Errandia do the search for you</h4>
                                                        <button onclick="location.href = '#';" class="btn btn-md">Run Errand
                                                            Now <i class="fa-solid fa-arrow-right icon"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    

                                    <!---end banneron sidebar-------->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-custome-9 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="show-button">
                        
                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Recently Posted Errands (<a class="nav-item" id="low" href="#">See All</a>)</h5>
                            </div>

                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/public/assets/svg/grid-3.svg') }}" class="blur-up lazyloaded" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/public/assets/svg/grid-4.svg') }}" class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="{{ asset('assets/public/assets/svg/grid.svg') }}" class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/public/assets/svg/list.svg') }}" class="blur-up lazyloaded" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        @foreach($errands as $errand)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="{{ asset('assets/public/assets/images/charger.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">{{$errand->title}}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 line-clamp-3">
                                                {{$errand->description}}
                                            </p>
                                            
                                            <h6 class="unit"><span class="fa fa-location"></span>{{$errand->street->name??''}},
                                                {{$errand->town->name??''}}, {{$errand->region->name??''}}</h6>
                                            </h5>
                                            <div class="add-to-cart-box bg-white shadow" >
                                                <button class="btn btn-add-cart">Call this Customer
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text" name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="">

                <div class="fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="show-button">
                        
                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Featured Products (<a class="nav-item" id="low" href="#">See All</a>)</h5>
                            </div>

                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/public/assets/svg/grid-3.svg') }}" class="blur-up lazyloaded" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/public/assets/svg/grid-4.svg') }}" class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="{{ asset('assets/public/assets/svg/grid.svg') }}" class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/public/assets/svg/list.svg') }}" class="blur-up lazyloaded" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        @for($i = 0; $i < 8; $i++)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('public.products.show', 'slug') }}">
                                                <img src="{{ asset('assets/public/assets/images/charger.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <a href="{{ route('public.products.show', 'slug') }}">
                                                <h5 class="name">I need a Dell Laptop charger</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Cheesy feet cheesy grin brie.
                                                Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly
                                                cheese macaroni cheese croque monsieur.</p>
                                            
                                            <h6 class="unit"><span class="fa fa-location"></span>Akwa, Douala</h6>
                                            </h5>
                                            <div class="add-to-cart-box shadow bg-white">
                                                <button class="btn btn-add-cart">Call the Supplier
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text" name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-to-cart-box bg-success text-white">
                                                <button class="btn btn-add-cart text-white">Chat on Whatsapp
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa fa-whatsapp"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text" name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="container-fluid-lg shadow my-5">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain">
                        <div class="banner-contain hover-effect bg-size blur-up lazyloaded" style="background-image: url({{ asset('asstes/public/assets/images/vegetable/banner/15.jpg') }}); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                            <img src="{{ asset('assets/public/assets/images/vegetable/banner/15.jpg' )}}" class="bg-img blur-up lazyload" alt="" style="display: none;">
                            <div class="banner-details p-center p-sm-4 p-3 text-white text-center">
                                <div>
                                    <h3 class="lh-base fw-bold text-light">Get $3 Cashback! Min Order of $30</h3>
                                    <h6 class="coupon-code">Use Code : GROCERY1920</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="">

                <div class="fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="show-button">
                        
                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h2 class="text-content">Popular Categories (<a class="nav-item" id="low" href="#">See All</a>)</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        @foreach (\App\Models\Category::orderBy('name')->get() as $category)
                            <div class="MuiBox-root css-q4zoya">
                                <div  class="d-flex">
                                    <img alt="motors" src="{{ asset('assets/admin/icons/'.$category->image_path.'.svg') }}" style="width: 2.2rem; height: 2.2rem; mr-4 mb-2">
                                    <h5 class=" d-inlineblock ml-3"><b>{{ $category->name }}</b> <small> (N errands recieved)</small></h5>
                                </div>
                                <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column css-1wkwmmc">
                                    @foreach ($category->sub_categories()->take(4)->get() as $subcat)
                                        <div class="MuiGrid-root MuiGrid-item css-1wxaqej">
                                            <a class="MuiTypography-root MuiTypography-inherit MuiLink-root MuiLink-underlineAlways css-u00jnd" data-testid="subcategory-link" href="/motors/used-cars/">{{ $subcat->name }}</a>
                                        </div>
                                    @endforeach
                                    <div class="">
                                        <a class="text-danger" tabindex="0" href="/classified/mobile-phones-pdas/">All in Mobile Phones &amp; Tablets</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection