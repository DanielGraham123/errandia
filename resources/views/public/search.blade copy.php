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
                                <input type="search" value="{{ $search_string ?? '' }}" name="searchString" class="form-control" placeholder="I am searching for ..." required aria-label="Example text with button addon">
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
                            
                            <h3 class="text-h6 px-5">{{ count($products ?? []) }} item(s) found.</h3>

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
                    </div>

                    <div class="row g-sm-4 g-3 product-list-section row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2">
                        @foreach ($products as $key=>$prod)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('public.business.show', 'slug') }}">
                                                <img src="{{ $prod->image_path != null ? asset('uploads/item_images/'.$prod->image_path) : asset('assets/images/default1.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail text-center">
                                            <div class="text-body">{{ $prod->name }}</div>
                                            <h6 class="text-primary my-2" style="font-weight: 600;">XAF {{ $prod->price??'NOT SET' }}</h6>
                                            <a href="{{ route('public.business.show', 'slug') }}">
                                                <h5 class="name py-2 bg-white">{{ $prod->shop->name }}</h5>
                                            </a>
                                            <h6 class="unit"><span class="fa fa-location"></span>{{ $prod->shop->contactInfo->location() }}</h6>
                                            </h5>
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

                    <hr class="mb-5">

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
                                <div class="product-box-3 h-100 wow fadeInUp " style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-footer">
                                        <div class="product-detail text-center">
                                            <a href="{{ route('public.business.show', 'slug') }}">
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
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

@endsection
