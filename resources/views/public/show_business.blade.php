@extends('public.layout')
@section('section')
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="card shadow bg-white px-2 py-3" style="border-radius: 1rem;">
                        <div class="card-body">
                            <span class="text-h6 d-block text-center mx-auto">{{ $business->name }}</span> <span class="fas fa-verified text-info fa-2x"></span><br>
                            @if ($business->image_path != null)
                                <img src="{{ asset('uploads/logos/'.$business->image_path) }}" class="img-responsive mx-auto my-3 d-block" style="width: 12rem; height: auto;">
                            @else
                                <span class="fa fa-cog fa-5x text-h1 d-block text-center"></span>
                            @endif
                            <div class="my-2 d-flex justify-content-center">
                                <span class="mr-3">
                                    <span class="fa fa-star {{ $business->rating??0 > 0  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $business->rating??0 > 1  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $business->rating??0 > 2  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $business->rating??0 > 3  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $business->rating??0 > 4  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                </span>
                                <b class="">{{ $business->rating??0 }} Ratings</b>
                            </div>
                            
                            <div class="my-2 d-flex">
                                <img class="mr-3" styl="height: 2rem; width: 2rem;" src="{{ asset('assets/badmin/icon-location.svg') }}">
                                <b class="">{{ $business->location() }}</b>
                            </div>
                            <div class="my-2 d-flex">
                                <img class="mr-3" styl="height: 2rem; width: 2rem;" src="{{ asset('assets/badmin/icon-member.svg') }}">
                                <b class="">Member since {{ \Carbon\Carbon::parse($business->created_at)->format('Y') }}</b>
                            </div>

                            <div class="my-2 d-flex justify-content-center">
                                <a class="button-primary " href=""><span class="fa fa-whatsapp"></span> Chat on Whatsapp</a>
                            </div>
                            <div class="my-2 d-flex justify-content-center">
                                <a class="button-secondary " href=""><span class="fa fa-phone"></span> Call 672387532</a>
                            </div>
                            <div class="my-2 d-flex justify-content-center ">
                                <a class="button-secondary " href=""> Follow this Business</a>
                            </div>

                            <div class="my-2 text-body">
                                Follow us on social media <br>
                                <span class="fa fa-facebook fa-2x mt-2 mx-2 text-info"></span>
                                <span class="fa fa-instagram fa-2x mt-2 mx-2 text-overline"></span>
                            </div>

                            <hr class="my-4">
                            <span class="text-h6 mb-3">Visit Our Other Branches</span><br>
                            @forelse ($branches as $branch)
                                <a href="{{ route('public.business.show', $branch->slug) }}" class="my-2 d-flex">
                                    <span class="fa fa-angle-right fa-2x mr-3"></span>
                                    @if ($branch->image_path != null)
                                        <img src="{{ asset('uploads/logos/'.$branch->image_path) }}" class="img-responsive mx-auto" style="width: 1.5rem; height: 1.5rem;">
                                    @else
                                        <span class="fa fa-cog fa-2x text-h1 d-block text-center"></span>
                                    @endif
                                    <b class="ml-3"> {{ $branch->location() }}</b>
                                </a>
                            @empty
                                <div class="my-2 d-flex">
                                    <span class="fa fa-caret-right fa-2x mr-3"></span>
                                    @if ($business->image_path != null)
                                        <img src="{{ asset('uploads/logos/'.$business->image_path) }}" class="img-responsive mx-auto" style="width: 1.5rem; height: 1.5rem;">
                                    @else
                                        <span class="fa fa-cog fa-2x text-h1 d-block text-center"></span>
                                    @endif
                                    <b class="ml-3">Business Location</b>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9 col-lg-8">
                    <div class="dashboard-right-sidebar">
                        <div>
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-dashboard-tab">
                                <div class="dashboard-home">



                                    {{-- PRODUCTS START --}}
                                    <div class="col-12">
                                        <div class="title title-flex">
                                            <div class="section-b-space">
                                                <div class="mb-5">
                                                    <h3>Products (<a class="">See All</a>)</h3>
                                                </div>
                                                <div class="product-border border-row overflow-hidden">
                                                    <div class="product-box-slider no-arrow slick-initialized slick-slider"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: inline-block;">Previous</button>
                                                        
                                                            <div class="slick-slide slick-active" tabindex="0" data-slick-index="1" aria-hidden="false">
                                                                <div class="row m-0">
                                                                    @for ($i=0; $i < 6; $i++)
                                                                        <div class="col-12 col-lg-4 col-xxl-3 px-0">
                                                                            <div class="product-box shadow">
                                                                                <div class="product-image">
                                                                                    <a href="{{ route('public.products.show', 'slug') }}" tabindex="0">
                                                                                        <img src="{{ asset('assets/public/assets/images/vegetable/product/3.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-detail">
                                                                                    <a href="{{ route('public.products.show', 'slug') }}" tabindex="0">
                                                                                        <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">Peanut Butter Bite Premium Butter Cookies 600 g
                                                                                        </h6>
                                                                                    </a>

                                                                                    <h5 class="sold text-content">
                                                                                        <span class="theme-color price">$26.69</span>
                                                                                    </h5>

                                                                                    <div class="add-to-cart-box">
                                                                                        <a href="{{ route('public.products.show', 'slug') }}" class="button-secondary">see more</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        
                                        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button></div>
                                    </div>
                                    {{-- PRODUCTS END --}}

                                    {{-- SERVICES START --}}
                                    <div class="col-12">
                                        <div class="title title-flex">
                                            <div class="section-b-space">
                                                <div class="mb-5">
                                                    <h3>Services (<a class="">See All</a>)</h3>
                                                </div>
                                                <div class="product-border border-row overflow-hidden">
                                                    <div class="product-box-slider no-arrow slick-initialized slick-slider"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: inline-block;">Previous</button>
                                                        
                                                            <div class="slick-slide slick-active" tabindex="0" data-slick-index="1" aria-hidden="false">
                                                                <div class="row m-0">
                                                                    @for ($i=0; $i < 6; $i++)
                                                                        <div class="col-12 col-lg-4 col-xxl-3 px-0">
                                                                            <div class="product-box shadow">
                                                                                <div class="product-image">
                                                                                    <a href="product-left-thumbnail.html" tabindex="0">
                                                                                        <img src="{{ asset('assets/public/assets/images/vegetable/product/3.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-detail">
                                                                                    <a href="product-left-thumbnail.html" tabindex="0">
                                                                                        <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">Peanut Butter Bite Premium Butter Cookies 600 g
                                                                                        </h6>
                                                                                    </a>

                                                                                    <h5 class="sold text-content">
                                                                                        <span class="theme-color price">$26.69</span>
                                                                                        <del>28.56</del>
                                                                                    </h5>

                                                                                    <div class="add-to-cart-box">
                                                                                        <a href="#" class="button-secondary">see more</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button></div>
                                    </div>
                                    {{-- SERVICES END --}}

                                    {{-- Tabbed content Start --}}
                                    <section>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-section-box m-0">
                                                        <ul class="nav nav-tabs custom-nav no-scrollbar" id="myTab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="care" aria-selected="false">Profile</button>
                                                            </li>
                                                        

                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="true">Reviews</button>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content custom-tab" id="myTabContent">
                                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="care-tab">
                                                                
                                                            </div>

                                                            <div class="tab-pane fade active show" id="review" role="tabpanel" aria-labelledby="review-tab">
                                                                <div class="review-box">
                                                                    <div class="row g-4">
                                                                        <div class="col-xl-6">
                                                                            <div class="review-title">
                                                                                <h4 class="fw-500">Customer reviews</h4>
                                                                            </div>

                                                                            <div class="d-flex">
                                                                                <div class="product-rating">
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
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                                        </li>
                                                                                        <li>
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <h6 class="ms-3">4.2 Out Of 5</h6>
                                                                            </div>

                                                                            <div class="rating-box">
                                                                                <ul>
                                                                                    <li>
                                                                                        <div class="rating-list">
                                                                                            <h5>5 Star</h5>
                                                                                            <div class="progress">
                                                                                                <div class="progress-bar" role="progressbar" style="width: 68%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                                                    68%
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li>
                                                                                        <div class="rating-list">
                                                                                            <h5>4 Star</h5>
                                                                                            <div class="progress">
                                                                                                <div class="progress-bar" role="progressbar" style="width: 67%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                                                    67%
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li>
                                                                                        <div class="rating-list">
                                                                                            <h5>3 Star</h5>
                                                                                            <div class="progress">
                                                                                                <div class="progress-bar" role="progressbar" style="width: 42%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                                                    42%
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li>
                                                                                        <div class="rating-list">
                                                                                            <h5>2 Star</h5>
                                                                                            <div class="progress">
                                                                                                <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                                                    30%
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li>
                                                                                        <div class="rating-list">
                                                                                            <h5>1 Star</h5>
                                                                                            <div class="progress">
                                                                                                <div class="progress-bar" role="progressbar" style="width: 24%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                                                    24%
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-6 h-100 d-flex flex-column justify-content-center">
                                                                            <a href="#" class="button-secondary my-5 mx-auto">Login to Add Your Review</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    {{-- Tabbed content End--}}


                                    <div class="container-fluid py-4">
                                        <h2>Business Branches</h2>
                                    </div>
                                    <div class="col-custome-12">
                                        <div class="row g-sm-4 g-3 product-list-section row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2">
                                            @for ($i=0; $i < 12; $i++)
                                                <div>
                                                    <div class="product-box-3 h-100 wow fadeInUp shadow bg-white" style="visibility: visible; animation-name: fadeInUp;">
                                                        <div class="product-header">
                                                            <div class="product-image">
                                                                <a href="{{ route('public.business.show', 'slug') }}">
                                                                    <img src="{{ asset('assets/images/nishang.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-footer">
                                                            <div class="product-detail">
                                                                <a href="{{ route('public.business.show', 'slug') }}">
                                                                    <h5 class="name">Nishang System</h5>
                                                                </a>
                                                                <h6 class="unit"><span class="fa fa-location"></span>Akwa, Douala</h6>
                                                                </h5>
                                                                <div class="add-to-cart-box bg-white shadow" >
                                                                    <a  href="{{ route('public.business.show', 'slug') }}" class="btn btn-add-cart">Check this Business
                                                                        <span class="add-icon bg-light-gray">
                                                                            <i class="fa fa-business-time"></i>
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
                                            @endfor

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-custome-12">
            </div>
        </div>
    </section>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Related Businesses</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto row g-sm-4 g-3 product-list-section row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-2">
            @for ($i=0; $i < 12; $i++)
                <div>
                    <div class="product-box-3 h-100 wow fadeInUp shadow bg-white" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="product-header">
                            <div class="product-image">
                                <a href="{{ route('public.business.show', 'slug') }}">
                                    <img src="{{ asset('assets/images/nishang.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-detail">
                                <a href="{{ route('public.business.show', 'slug') }}">
                                    <h5 class="name">Nishang System</h5>
                                </a>
                                <h6 class="unit"><span class="fa fa-location"></span>Akwa, Douala</h6>
                                </h5>
                                <div class="add-to-cart-box bg-white shadow" >
                                    <a  href="{{ route('public.business.show', 'slug') }}" class="btn btn-add-cart">Check this Business
                                        <span class="add-icon bg-light-gray">
                                            <i class="fa fa-business-time"></i>
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
            @endfor

        </div>
    </section>
@endsection
@section('script')

@endsection
