@extends('public.layout')
@section('section')
    <section class="home-section-2 home-section-bg pt-0 overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="slider-animate">
                        <div>
                            <div class="home-contain rounded-0 p-0 bg-size blur-up lazyloaded" style="background-image: url({{asset('assets/public/assets/images/landing-image/home.png')}}); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                <img src="{{asset('assets/public/assets/images/search.png')}}" class="img-fluid bg-img blur-up lazyloaded" alt="" style="display: none;">
                                <div class="home-detail home-big-space home-overlay position-relative" style="background: rgba(90,90,90,0.7);">
                                    <div class="container-fluid-lg">
                                         <header class="pb-md-4 pb-0">
                                            <div class="top-nav top-header">
                                                <div class="container-fluid-lg">
                                                    <div class="container text-center">
                                                        <h3 class="h3 mt-3 text-white">Search for Products and Services within Cameroon with Errandia</h3>
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



    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-12">

                    <div class="title">
                        <h2>Browse by Categories</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href=" {{ asset('assets/public/assets/svg/leaf.svg') }}"></use>
                            </svg>
                        </span>
                        <p>Top Categories Of The Week</p>
                    </div>
                    
                    <div class="d-flex no-scrollbar" style="overflow-x: scroll;">
                        <div class="d-flex category-slider-2 product-wrapper no-arrow slick-initialized slick-slider slick-dotted">
                            @foreach (\App\Models\Category::inRandomOrder()->get() as $category)
                                <div class="slick-slide slick-cloned" style="width: 189px;" tabindex="-1" role="tabpanel" id="" aria-describedby="slick-slide-control06" data-slick-index="13" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src=" {{ asset('assets/admin/icons/'.$category->image_path.'.svg') }}" class="blur-up lazyloaded" alt="">
                                            <h5>{{ $category->name }}</h5>
                                        </div>
                                    </a>
                                </div>
                                
                            @endforeach
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-12">

                    <div class="title">
                        <h2>Featured Businesses</h2>
                    </div>
                    <div class="d-flex no-scrollbar" style="overflow-x: scroll;">
                        <div class="d-flex category-slider-2 product-wrapper no-arrow slick-initialized slick-slider slick-dotted">
                            @foreach (\App\Models\Shop::inRandomOrder()->get() as $shop)
                                <div class="slick-slide slick-cloned" style="width: 189px;" tabindex="-1" role="tabpanel" id="" aria-describedby="slick-slide-control06" data-slick-index="13" aria-hidden="true">
                                    <a href="{{ route('public.business.show', $shop->slug) }}" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src=" {{ asset('assets/admin/images/business-logo-thumb-0.png') }}" class="blur-up lazyloaded" alt="">
                                            <h5>{{ $shop->name }}</h5>
                                            <p class="text-overline">{{ $shop->location() }}</p>
                                        </div>
                                    </a>
                                </div>
                                
                            @endforeach
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>





    



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
                        @for($i = 0; $i < 9; $i++)
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
                                                <h5 class="name">I need a Dell Laptop charger</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 line-clamp-3">Cheesy feet cheesy grin brie.
                                                Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly
                                                cheese macaroni cheese croque monsieur.</p>
                                            
                                            <h6 class="unit"><span class="fa fa-location"></span>Akwa, Douala</h6>
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
                        @endfor
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
@section('script')

@endsection
