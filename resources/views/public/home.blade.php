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
                                                        <h3 class="h3 mt-3 text-white">Search for Products.Run Errands</h3>
                                                        <span class="d-block h5 mb-3 text-white">Find or sell products and services</span>
                                                    </div>
                                                    <div class="navbar-top mx-auto">
                                                        
                                                        <div class="middle-box mx-auto">
                                                            <div class="location-box bg-white">
                                                                <button class="btn location-button" data-bs-toggle="modal"
                                                                    data-bs-target="#locationModal">
                                                                    <span class="location-arrow">
                                                                        <i data-feather="map-pin"></i>
                                                                    </span>
                                                                    <span class="locat-name">Your Location</span>
                                                                    <i class="fa-solid fa-angle-down"></i>
                                                                </button>
                                                            </div>

                                                            <div class="search-box">
                                                                <div class="input-group">
                                                                    <input type="search" class="form-control" placeholder="I'm searching for..."
                                                                        aria-label="Recipient's username" aria-describedby="button-addon2">
                                                                    <button class="btn" type="button" id="button-addon2">
                                                                        <i data-feather="search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

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

    <section class="product-section-3 py-5">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Featured Businesses</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-7_1 arrow-slider img-slider slick-initialized slick-slider"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button>
                        
                    <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 4740px; transform: translate3d(-948px, 0px, 0px);"><div class="slick-slide slick-cloned" style="width: 237px;" data-slick-index="-4" id="" aria-hidden="true" tabindex="-1">


                        </div><div class="slick-slide slick-cloned" style="width: 237px;" data-slick-index="-3" id="" aria-hidden="true" tabindex="-1">
                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                <div class="product-image product-image-2">
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <img src="{{ asset('assets/public/assets/images/grocery/product/fruits-vegetables/6.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                    </a>

                                   
                                </div>

                                <div class="product-detail">
                                    <ul class="rating">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                    </ul>
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <h5 class="name text-title">Broccoli</h5>
                                    </a>
                                    <h5 class="price theme-color">$65.21<del>$71.25</del></h5>
                                    <div class="addtocart_btn">
                                        <button class="add-button addcart-button btn buy-button text-light" tabindex="-1">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <div class="qty-box cart_qty">
                                            <div class="input-group">
                                                <button type="button" class="btn qty-left-minus" data-type="minus" data-field="" tabindex="-1">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text" name="quantity" value="1" tabindex="-1">
                                                <button type="button" class="btn qty-right-plus" data-type="plus" data-field="" tabindex="-1">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="slick-slide slick-cloned" style="width: 237px;" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1">
                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                <div class="product-image product-image-2">
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <img src="{{ asset('assets/public/assets/images/grocery/product/fruits-vegetables/7.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                    </a>

                                    <ul class="option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view" tabindex="-1">
                                                <i class="iconly-Show icli"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Wishlist">
                                            <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                <i class="iconly-Heart icli"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Compare">
                                            <a href="compare.html" tabindex="-1">
                                                <i class="iconly-Swap icli"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <ul class="rating">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                    </ul>
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <h5 class="name text-title">Apple</h5>
                                    </a>
                                    <h5 class="price theme-color">$65.21<del>$71.25</del></h5>
                                    {{-- <div class="addtocart_btn">
                                        <button class="add-button addcart-button btn buy-button text-light" tabindex="-1">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <div class="qty-box cart_qty">
                                            <div class="input-group">
                                                <button type="button" class="btn qty-left-minus" data-type="minus" data-field="" tabindex="-1">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text" name="quantity" value="1" tabindex="-1">
                                                <button type="button" class="btn qty-right-plus" data-type="plus" data-field="" tabindex="-1">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div><div class="slick-slide slick-cloned" style="width: 237px;" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1">
                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.35s" style="visibility: visible; animation-delay: 0.35s; animation-name: fadeInUp;">
                                <div class="product-image product-image-2">
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <img src="{{ asset('assets/public/assets/images/grocery/product/fruits-vegetables/8.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                    </a>
                                </div>

                                <div class="product-detail">
                                    {{-- <ul class="rating">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                    </ul> --}}
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <h5 class="name text-title">Strawberry</h5>
                                    </a>
                                    <h5 class="price theme-color">$65.21<del>$71.25</del></h5>
                                    <div class="addtocart_btn">
                                        <button class="add-button addcart-button btn buy-button text-light" tabindex="-1">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <div class="qty-box cart_qty">
                                            <div class="input-group">
                                                <button type="button" class="btn qty-left-minus" data-type="minus" data-field="" tabindex="-1">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text" name="quantity" value="1" tabindex="-1">
                                                <button type="button" class="btn qty-right-plus" data-type="plus" data-field="" tabindex="-1">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide slick-cloned" style="width: 237px;" data-slick-index="14" id="" aria-hidden="true" tabindex="-1">
                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                <div class="product-image product-image-2">
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <img src="{{ asset('assets/public/assets/images/grocery/product/fruits-vegetables/7.png') }}" class="img-fluid blur-up lazyload" alt="">
                                    </a>

                                    <ul class="option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view" tabindex="-1">
                                                <i class="iconly-Show icli"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Wishlist">
                                            <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                <i class="iconly-Heart icli"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Compare">
                                            <a href="compare.html" tabindex="-1">
                                                <i class="iconly-Swap icli"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <ul class="rating">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </li>
                                    </ul>
                                    <a href="product-left-thumbnail.html" tabindex="-1">
                                        <h5 class="name text-title">Apple</h5>
                                    </a>
                                    <h5 class="price theme-color">$65.21<del>$71.25</del></h5>
                                    {{-- <div class="addtocart_btn">
                                        <button class="add-button addcart-button btn buy-button text-light" tabindex="-1">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <div class="qty-box cart_qty">
                                            <div class="input-group">
                                                <button type="button" class="btn qty-left-minus" data-type="minus" data-field="" tabindex="-1">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text" name="quantity" value="1" tabindex="-1">
                                                <button type="button" class="btn qty-right-plus" data-type="plus" data-field="" tabindex="-1">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        </div></div><button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button></div>
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
                        @for($i = 0; $i < 18; $i++)
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
                                            <p class="text-content mt-1 mb-2 product-content">Cheesy feet cheesy grin brie.
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
                        @for($i = 0; $i < 18; $i++)
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


@endsection
@section('script')

@endsection
