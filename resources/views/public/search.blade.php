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
                                    
                    <!-- Product Sction Start -->
                    <section class="product-section">
                        <div class="container-fluid-lg">
                            <div class="title">
                                <h4 class="text-h6">{{ count($products??[]) }} products found</h4>
                            </div>

                            <div class="slider-4 img-slider slick-slider-1 arrow-slider">
                                @for($i = 0; $i < count($products??[]); $i+=2)
                                    <div>
                                        <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="{{ $products[$i]->image_path != null ? asset('uploads/item_images/'.$products[$i]->image_path) : asset('assets/images/default1.jpg') }}" class="img-fluid" alt="">
                                                </a>
                                            </div>

                                            <div class="product-detail text-center">
                                                <a href="product-left-thumbnail.html" class="d-block">
                                                    <h5 class="name d-block mx-auto text-center">{{ $products[$i]->name??'' }}</h5>
                                                </a>
                                                <h5 class="price theme-color text-extra d-block text-center" style="font-weight: 600 !important;">XAF {{ $products[$i]->unit_price??"PRICE" }}</h5>
                                                <a href="{{ route('public.business.show', $products[$i]->shop->slug) }}">
                                                    <h6 class="text-extra bg-light py-2 rounded px-2 my-2">{{ $products[$i]->shop->name }}</h6>
                                                </a>
                                                <h6 class="unit"><span class="fa fa-location"></span>{{ $products[$i]->shop->contactInfo->location() }}</h6>
                                                </h5>
                                                <div class="add-to-cart-box bg-white shadow" >
                                                    <a  href="{{ route('public.business.show', $products[$i]->shop->slug) }}" class="btn btn-add-cart">Contact
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

                                        @isset($products[$i+1])
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <div class="product-image">
                                                    <a href="product-left-thumbnail.html">
                                                        <img src="{{ $products[$i+1]->image_path != null ? asset('uploads/item_images/'.$products[$i+1]->image_path) : asset('assets/images/default1.jpg') }}" class="img-fluid" alt="">
                                                    </a>
                                                </div>

                                                <div class="product-detail text-center">
                                                    <a href="product-left-thumbnail.html" class="d-block">
                                                        <h5 class="name d-block mx-auto text-center">{{ $products[$i+1]->name??'' }}</h5>
                                                    </a>
                                                    <h5 class="price theme-color text-extra d-block text-center" style="font-weight: 600 !important;">XAF {{ ($products[$i+1]->unit_price != null || $products[$i+1]->unit_price > 0)? $products[$i+1]->unit_price : "???" }}</h5>
                                                    <a href="{{ route('public.business.show', $products[$i+1]->shop->slug) }}">
                                                        <h6 class="text-extra bg-light py-2 rounded px-2 my-2">{{ $products[$i+1]->shop->name }}</h6>
                                                    </a>
                                                    <h6 class="unit"><span class="fa fa-location"></span>{{ $products[$i+1]->shop->contactInfo->location() }}</h6>
                                                    </h5>
                                                    <div class="add-to-cart-box bg-white shadow" >
                                                        <a  href="{{ route('public.business.show', $products[$i+1]->shop->slug) }}" class="btn btn-add-cart">Contact
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
                                        @endisset
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </section>
                    <!-- Product Sction End -->

                    <!-- Blog Section Start -->

                    @if(count($shops) > 0)
                        <section class="blog-section">
                            <div class="container-fluid-lg">
                                <div class="title">
                                    <h4 class="text-h6">Errandia suggests the following shops that might have "{{ $search_string }}"</h4>
                                </div>

                                <div class="slider-3 arrow-slider">
                                    @foreach ($shops as $shop)
                                        <div>
                                            <div class="blog-box ratio_50">
                                                <div class="blog-box-image">
                                                    <a href="{{ route('public.business.show', $shop->slug) }}">
                                                        <img src="{{$shop->image_path != null ? asset('uploads/logos/'.$shop->image_path) : asset('assets/images/default1.jpg') }}" class="img-fluid bg-img" alt="">
                                                    </a>
                                                </div>

                                                <div class="blog-detail">
                                                    <a href="blog-detail.html">
                                                        <h2>{{ $shop->name??'' }}</h2>
                                                    </a>
                                                    <div class="blog-list">
                                                        <span>{{ $shop->description }}</span>
                                                    </div>
                                                </div>
                                                <div class="add-to-cart-box bg-white shadow m-2" >
                                                    <a  href="{{ route('public.business.show', $shop->slug) }}" class="btn btn-add-cart">Contact
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
                                        
                                    @endforeach

                                    <div>
                                </div>
                            </div>
                        </section>
                    @endif
                    <!-- Blog Section End -->

                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

@endsection
