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
                                <a href="#" class="category-box category-dark wow fadeInUp">
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

                    <div>
                        <div class="show-button">
                            <div class="filter-button-group mt-0">
                                <div class="filter-button d-inline-block d-lg-none">
                                    <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                                </div>
                            </div>

                            <div class="top-filter-menu">
                                <div class="category-dropdown">
                                    <h5 class="text-content">Sort By :</h5>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown">
                                            <span>Most Popular</span> <i class="fa-solid fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" id="pop" href="javascript:void(0)">Popularity</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="low" href="javascript:void(0)">Low - High
                                                    Price</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="high" href="javascript:void(0)">High - Low
                                                    Price</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="rating" href="javascript:void(0)">Average
                                                    Rating</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="aToz" href="javascript:void(0)">A - Z Order</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="zToa" href="javascript:void(0)">Z - A Order</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="off" href="javascript:void(0)">% Off - Hight To
                                                    Low</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="grid-option d-none d-md-block">
                                    <ul>
                                        <li class="three-grid">
                                            <a href="javascript:void(0)">
                                                <img src="../assets/svg/grid-3.svg" class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li class="grid-btn d-xxl-inline-block d-none active">
                                            <a href="javascript:void(0)">
                                                <img src="../assets/svg/grid-4.svg"
                                                    class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                                <img src="../assets/svg/grid.svg"
                                                    class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
                                            </a>
                                        </li>
                                        <li class="list-btn">
                                            <a href="javascript:void(0)">
                                                <img src="../assets/svg/list.svg" class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/2.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Cheesy feet cheesy grin brie.
                                                Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly
                                                cheese macaroni cheese croque monsieur.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(4.0)</span>
                                            </div>
                                            <h6 class="unit">250 ml</h6>
                                            <h5 class="price"><span class="theme-color">$08.02</span> <del>$15.15</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.05s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/3.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Peanut Butter Bite Premium Butter Cookies 600 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Feta taleggio croque monsieur
                                                swiss manchego cheesecake dolcelatte jarlsberg. Hard cheese danish fontina
                                                boursin melted cheese fondue.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(2.4)</span>
                                            </div>
                                            <h6 class="unit">350 G</h6>
                                            <h5 class="price"><span class="theme-color">$04.33</span> <del>$10.36</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/4.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Snacks</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">SnackAmor Combo Pack of Jowar Stick and Jowar Chips</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Lancashire hard cheese
                                                parmesan. Danish fontina mozzarella cream cheese smelly cheese cheese and
                                                wine cheesecake dolcelatte stilton. Cream cheese parmesan who moved my
                                                cheese when the cheese comes out everybody's happy cream cheese red
                                                leicester ricotta edam.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                </ul>
                                                <span>(5.0)</span>
                                            </div>
                                            <h6 class="unit">570 G</h6>
                                            <h5 class="price"><span class="theme-color">$12.52</span> <del>$13.62</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.15s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/5.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Snacks</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Yumitos Chilli Sprinkled Potato Chips 100 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Cheddar cheddar pecorino hard
                                                cheese hard cheese cheese and biscuits bocconcini babybel. Cow goat paneer
                                                cream cheese fromage cottage cheese cauliflower cheese jarlsberg.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(3.8)</span>
                                            </div>
                                            <h6 class="unit">100 G</h6>
                                            <h5 class="price"><span class="theme-color">$10.25</span> <del>$12.36</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/6.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fantasy Crunchy Choco Chip Cookies</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Bavarian bergkase smelly
                                                cheese swiss cut the cheese lancashire who moved my cheese manchego melted
                                                cheese. Red leicester paneer cow when the cheese comes out everybody's happy
                                                croque monsieur goat melted cheese port-salut.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(4.0)</span>
                                            </div>

                                            <h6 class="unit">550 G</h6>

                                            <h5 class="price"><span class="theme-color">$14.25</span> <del>$16.57</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.25s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/7.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Melted cheese babybel chalk
                                                and cheese. Port-salut port-salut cream cheese when the cheese comes out
                                                everybody's happy cream cheese hard cheese cream cheese red leicester.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(3.8)</span>
                                            </div>

                                            <h6 class="unit">1 Kg</h6>

                                            <h5 class="price"><span class="theme-color">$12.68</span> <del>$14.69</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/2.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Squirty cheese cottage cheese
                                                cheese strings. Red leicester paneer danish fontina queso lancashire when
                                                the cheese comes out everybody's happy cottage cheese paneer.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(4.0)</span>
                                            </div>
                                            <h6 class="unit">250 ml</h6>
                                            <h5 class="price"><span class="theme-color">$08.02</span> <del>$15.15</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.35s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/3.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Peanut Butter Bite Premium Butter Cookies 600 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Swiss ricotta cauliflower
                                                cheese squirty cheese cheesy grin camembert de normandie airedale edam.
                                                Squirty cheese babybel cheesecake the big cheese cauliflower cheese hard
                                                cheese cheese and biscuits cheese and wine.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(2.4)</span>
                                            </div>
                                            <h6 class="unit">350 G</h6>
                                            <h5 class="price"><span class="theme-color">$04.33</span> <del>$10.36</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/4.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Snacks</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">SnackAmor Combo Pack of Jowar Stick and Jowar Chips</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Boursin the big cheese
                                                cheeseburger. Jarlsberg smelly cheese chalk and cheese gouda blue castello
                                                monterey jack swiss boursin. Halloumi cheesy feet mozzarella red leicester
                                                paneer boursin who moved my cheese croque monsieur.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                </ul>
                                                <span>(5.0)</span>
                                            </div>
                                            <h6 class="unit">570 G</h6>
                                            <h5 class="price"><span class="theme-color">$12.52</span> <del>$13.62</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.45s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/5.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Snacks</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Yumitos Chilli Sprinkled Potato Chips 100 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Halloumi mozzarella monterey
                                                jack smelly cheese emmental bocconcini when the cheese comes out everybody's
                                                happy pecorino. Cut the cheese stilton danish fontina cheesy grin rubber
                                                cheese smelly cheese roquefort paneer.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(3.8)</span>
                                            </div>
                                            <h6 class="unit">100 G</h6>
                                            <h5 class="price"><span class="theme-color">$10.25</span> <del>$12.36</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/6.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fantasy Crunchy Choco Chip Cookies</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Manchego cow cheddar.
                                                Port-salut roquefort hard cheese babybel when the cheese comes out
                                                everybody's happy brie dolcelatte croque monsieur.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(4.0)</span>
                                            </div>

                                            <h6 class="unit">550 G</h6>

                                            <h5 class="price"><span class="theme-color">$14.25</span> <del>$16.57</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.55s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/7.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Roquefort say cheese the big
                                                cheese ricotta chalk and cheese when the cheese comes out everybody's happy
                                                brie lancashire.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(3.8)</span>
                                            </div>

                                            <h6 class="unit">1 Kg</h6>

                                            <h5 class="price"><span class="theme-color">$12.68</span> <del>$14.69</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.6">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/2.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Lancashire when the cheese
                                                comes out everybody's happy blue castello halloumi boursin stinking bishop
                                                pecorino fromage frais.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(4.0)</span>
                                            </div>
                                            <h6 class="unit">250 ml</h6>
                                            <h5 class="price"><span class="theme-color">$08.02</span> <del>$15.15</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.65s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="../assets/images/cake/product/3.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">Peanut Butter Bite Premium Butter Cookies 600 g</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">Say cheese cheese and biscuits
                                                feta. Queso bocconcini danish fontina camembert de normandie brie airedale
                                                ricotta feta. Pecorino edam gouda caerphilly croque monsieur red leicester
                                                cheese triangles caerphilly.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                </ul>
                                                <span>(2.4)</span>
                                            </div>
                                            <h6 class="unit">350 G</h6>
                                            <h5 class="price"><span class="theme-color">$04.33</span> <del>$10.36</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </button>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <nav class="custome-pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">
                                        <i class="fa-solid fa-angles-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0)">1</a>
                                </li>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="javascript:void(0)">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Selling Section End -->

    
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