@extends('public.layout')
@section('section')

    <section class="search-section">
        <div class="container-fluid-lg mb-3 pt-5">
            <div class="row">
                <div class="col-xxl-6 col-xl-8 mx-auto">
                    <div class="title d-block text-center">
                        <h2>Search for products</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>

                    <form action="{{ route('public.search') }}" method="GET">
                        <div class="search-box">
                            <div class="input-group">
                                <input type="search" data-max-words="3"  data-announce="true" value="{{ $search_string ?? '' }}" name="searchString" class="form-control" placeholder="I am searching for ..." required aria-label="Example text with button addon">
                                <button class="btn theme-bg-color text-white m-0" type="submit" id="button-addon1">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            

            <div class="row">
                <div class="col-custome-3">
                    <div class="left-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="shop-left-sidebar">
                            <div class=""></div>
                            <div class="location-list nav-link">
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Region</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Town</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Street</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Categories</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-custome-9">   
                    @isset($products)
                        <div class="show-button">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa fa-filter"></i> Filter Menu</a>
                            </div>
                            <div class="top-filter-menu">
                                <div class="category-dropdown">
                                    <h5 class="text-content">Sort By :</h5>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
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

                                <ul class="nav nav-tabs tab-style-color-2 tab-style-color" id="myTab">
                                    <li class="nav-item">
                                        <button class="nav-link btn active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">All</button>
                                    </li>
                
                                    <li class="nav-item">
                                        <button class="nav-link btn" id="cooking-tab" data-bs-toggle="tab" data-bs-target="#cooking" type="button"> Products</button>
                                    </li>
                
                                    <li class="nav-item">
                                        <button class="nav-link btn" id="fruits-tab" data-bs-toggle="tab" data-bs-target="#fruits" type="button">Services</button>
                                    </li>
                
                                    <li class="nav-item">
                                        <button class="nav-link btn" id="beverage-tab" data-bs-toggle="tab" data-bs-target="#beverage" type="button">Businesses</button>
                                    </li>
                                </ul>    
                            
                                <div class="grid-option d-none d-md-block">
                                    <ul>
                                        <li class="three-grid active">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('assets/public/assets/svg/grid-3.svg') }}" class="blur-up lazyloaded" alt="">
                                            </a>
                                        </li>
                                        <li class="grid-btn d-xxl-inline-block d-none">
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
                            <div class="container-fluid bg-light py-2 text-end my-2">
                                <h3 class="text-h6 px-5">{{ count($products ?? []) }} item(s) found.</h3>
                            </div>
                        </div>

                        <div class="row g-sm-4 g-3 product-list-section row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2">
                            @forelse ($products??[] as $key=>$prod)
                                <div>
                                    <div class="product-box-3 h-100 wow fadeInUp shadow-md border" style="visibility: visible; animation-name: fadeInUp;">
                                        <div class="product-header">
                                            <div class="product-image">
                                                <a href="{{ route('public.products.show', $prod->slug) }}">
                                                    <img src="{{ $prod->featured_image != null ? asset('uploads/item_images/'.$prod->featured_image) : asset('assets/images/default1.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-footer">
                                            <div class="product-detail text-center">
                                                <div class="text-body">{{ $prod->name }}</div>
                                                <h6 class="text-primary my-2" style="font-weight: 600;">XAF {{ $prod->unit_price??'NOT SET' }}</h6>
                                                <a href="{{ route('public.business.show', $prod->shop->slug) }}">
                                                    <h5 class="name py-2 bg-white">{{ $prod->shop->name }}</h5>
                                                </a>
                                                <h6 class="unit"><span class="fa fa-location"></span>{{ $prod->shop->contactInfo->location() }}</h6>
                                                </h5>
                                                <div class="add-to-cart-box bg-white shadow" >
                                                    <a  href="tel:{{ $prod->shop->contactInfo->phone }}" class="btn btn-add-cart">Contact
                                                        <span class="add-icon bg-light-gray">
                                                            <i class="fa fa-phone"></i>
                                                        </span>
                                                    </a>
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
                            @empty
                                <div class="card bg-light my-2 w-100 py-1"><div class="card-body text-center px-3 py-1">
                                    <p>Sorry we could not find any product related to your search</p>
                                    <p class="text-h6">"{{ $search_string??'' }}"</p>
                                </div></div>
                            @endforelse
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
                    @endisset                 

                    <hr class="mb-5">
                    @if (count($shops??[]) > 0)
                        <div class="show-button">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa fa-filter"></i> Filter Menu</a>
                            </div>
                            <div class="top-filter-menu">
                                
                                <h3 class="text-h6 px-5">Errandia suggests  the following shops that might have "{{ $search_string }}"</h3>
                            </div>
                        </div>

                        <div class="row g-sm-4 g-3 product-list-section row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2">
                            @foreach ($shops as $key=>$shop)
                                <div>
                                    <div class="product-box-3 h-100 wow fadeInUp shadow-md border" style="visibility: visible; animation-name: fadeInUp;">
                                        <div class="product-header">
                                            <div class="product-image">
                                                <a href="{{ route('public.business.show', $shop->slug) }}">
                                                    <img src="{{ $shop->image_path != null ? asset('uploads/logos/'.$shop->image_path) : asset('assets/images/default1.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-footer">
                                            <div class="product-detail text-center">
                                                <a href="{{ route('public.business.show', $shop->slug) }}">
                                                    <h5 class="name py-2 bg-white">{{ $shop->name }}</h5>
                                                </a>
                                                <h6 class="unit"><span class="fa fa-location"></span>{{ $shop->contactInfo->location() }}</h6>
                                                
                                                <div class="add-to-cart-box bg-white shadow" >
                                                    <a  href="{{ route('public.business.show', 'slug') }}" class="btn btn-add-cart">Contact
                                                        <span class="add-icon bg-light-gray">
                                                            <i class="fa fa-phone"></i>
                                                        </span>
                                                    </a>
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
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

@endsection
