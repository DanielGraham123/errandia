@extends('b_admin.ns_layout')
@section('section')
        <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>{{ $item->name ?? '' }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $item->name?? '' }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            @foreach($item->images as $key=>$img)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('uploads/item_images/'.$img->image) }}" id="img-1"
                                                            data-zoom-image="{{  asset('uploads/item_images/'.$img->image) }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                            @endforeach

                                            
                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            @foreach($item->images as $key=>$img)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('uploads/item_images/'.$img->image) }}" id="img-1"
                                                            data-zoom-image="{{ asset('uploads/item_images/'.$img->image) }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                <h6 class="offer-top">available</h6>
                                <h2 class="name">{{ $item->name??'' }}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">CFA {{ number_format($item->unit_price??0) }} </h3>
                                    <div class="product-rating custom-rate">
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
                                        <span class="review">23 Customer Review</span>
                                    </div>
                                </div>

                                <div class="procuct-contain">
                                    <p class="line-clamp-3">{{$item->description ?? ''}}
                                    </p>
                                </div>
{{-- 

                                <div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                    data-hours="1" data-minutes="2" data-seconds="3">
                                    <div class="product-title">
                                        <h4>Hurry up! Sales Ends In</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="days d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Days</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="hours d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Hours</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="minutes d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Min</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="seconds d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Sec</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
 --}}


                                <div class="note-box product-packege">
                                   
                                    <button onclick="location.href = `https://wa.me/{{ $item->shop->contactInfo->whatsapp??'' }}`;"
                                        class="btn btn-md bg-success cart-button text-white w-100"><i class="fa fa-whatsapp mr-2 d-inlineblock"></i> &nbsp; Chat on WhatsApp</button>

                                    <button onclick="location.href = `tel:{{ $item->shop->contactInfo->phone }}`"
                                        class="btn btn-md bg-dark cart-button text-white w-100"><i class="fa fa-phone mr-2 d-inlineblock"></i> &nbsp; Call</button>
                                </div>

                               
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Description</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                            data-bs-target="#info" type="button" role="tab" aria-controls="info"
                                            aria-selected="false">Business Profile</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="care-tab" data-bs-toggle="tab"
                                            data-bs-target="#care" type="button" role="tab" aria-controls="care"
                                            aria-selected="false">Enquiry</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                            aria-selected="false">Review</button>
                                    </li>
                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p>{{ $item->description??'' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                        <div class="table-responsive">
                                            <table class="table info-table">
                                                <tbody>
                                                    <tr>
                                                        <td>Business Name</td>
                                                        <td><b class="text-primary h5">{{ $item->shop->name??'' }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td><b class="text-primary h5">{{ $item->shop->contactInfo->location() }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Member since</td>
                                                        <td><b class="text-primary h5">{{ now()->diffInMonths($item->shop->created_at) }} months ago</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Reg.Info Follows</td>
                                                        <td><b class="text-primary h5">{{ now()->diffInMonths($item->shop->created_at) }} months ago</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
                                        <div class="information-box">
                                            <div class="row g-4">
                                                <div class="col-xl-5 ">
                                                    <div class="d-flex justify-content-center flex-wrap py-4">
                                                        @if (auth()->user() == null)
                                                            <a class="button-primary mb-5" href="{{ route('login') }}">Login to make enquiry</a><br>
                                                            <span class="text-extra">Don't have an account? <a href="{{ route('register') }}" class="button-secondary">create and account</a></span>
                                                        @else
                                                            <h5 class="text-h6">Make an enquiry</h5>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-7">
                                                    @if(auth()->check())
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="review-title">
                                                                    <h4 class="fw-500">Make enquiry</h4>
                                                                </div>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                                    <div class="row g-4">
                
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <input type="url" class="form-control" id="review1"
                                                                                    placeholder="Item name" name="title">
                                                                                <label for="review1">Enquiry Item name</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <input type="file" accept="image/*" multiple class="form-control" id="limitedImages"
                                                                                    placeholder="upload review images" name="images" oninput="imageChanged(event)">
                                                                                <label for="review1">Item image(s)</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating theme-form-floating d-flex" id="preview_box">
                                                                                
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="col-12">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="Leave a comment here"
                                                                                    id="floatingTextarea2"
                                                                                    style="height: 150px" name="description"></textarea>
                                                                                <label for="floatingTextarea2">Write Your
                                                                                    Enquiry</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end py-2">
                                                                        <button type="submit" class="button-secondary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                        <div class="review-box">
                                            @if (auth()->check())
                                                <div class="row g-4">
                                                    <div class="col-xl-6">
                                                        <div class="review-title">
                                                            <h4 class="fw-500">Customer reviews</h4>
                                                        </div>

                                                        <div class="d-flex">
                                                            <div class="product-rating">
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
                                                            </div>
                                                            <h6 class="ms-3">4.2 Out Of 5</h6>
                                                        </div>

                                                        <div class="rating-box">
                                                            <ul>
                                                                <li>
                                                                    <div class="rating-list">
                                                                        <h5>5 Star</h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="width: 68%" aria-valuenow="100"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                68%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="rating-list">
                                                                        <h5>4 Star</h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="width: 67%" aria-valuenow="100"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                67%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="rating-list">
                                                                        <h5>3 Star</h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="width: 42%" aria-valuenow="100"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                42%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="rating-list">
                                                                        <h5>2 Star</h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="width: 30%" aria-valuenow="100"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                30%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="rating-list">
                                                                        <h5>1 Star</h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="width: 24%" aria-valuenow="100"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                24%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="review-title">
                                                                    <h4 class="fw-500">Add a review</h4>
                                                                </div>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="name" value="{{ auth()->id() }}">
                                                                    <div class="row g-4">
                                                                        
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <input type="file" accept="image/*" multiple class="form-control" id="limitedImages"
                                                                                    placeholder="upload review images" name="images" oninput="reviewImageChanged(event)">
                                                                                <label for="review1">Item image(s)</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating theme-form-floating d-flex" id="review_preview_box">
                                                                                
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="col-12">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="Leave a comment here"
                                                                                    id="floatingTextarea2" name="description"
                                                                                    style="height: 150px"></textarea>
                                                                                <label for="floatingTextarea2">Write Your
                                                                                    Comment</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end py-2">
                                                                        <button type="submit" class="button-secondary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="review-title">
                                                            <h4 class="fw-500">Customer questions & answers</h4>
                                                        </div>

                                                        <div class="review-people">
                                                            <ul class="review-list">
                                                                <li>
                                                                    <div class="people-box">
                                                                        <div>
                                                                            <div class="people-image">
                                                                                <img src="../assets/images/review/1.jpg"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="people-comment">
                                                                            <a class="name"
                                                                                href="javascript:void(0)">Tracey</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content">14 Jan, 2022 at
                                                                                    12.58 AM</h6>

                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class="reply">
                                                                                <p>Icing cookie carrot cake chocolate cake
                                                                                    sugar plum jelly-o danish. Dragée dragée
                                                                                    shortbread tootsie roll croissant muffin
                                                                                    cake I love gummi bears. Candy canes ice
                                                                                    cream caramels tiramisu marshmallow cake
                                                                                    shortbread candy canes cookie.<a
                                                                                        href="javascript:void(0)">Reply</a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="people-box">
                                                                        <div>
                                                                            <div class="people-image">
                                                                                <img src="../assets/images/review/2.jpg"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="people-comment">
                                                                            <a class="name"
                                                                                href="javascript:void(0)">Olivia</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content">01 May, 2022 at
                                                                                    08.31 AM</h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class="reply">
                                                                                <p>Tootsie roll cake danish halvah powder
                                                                                    Tootsie roll candy marshmallow cookie
                                                                                    brownie apple pie pudding brownie
                                                                                    chocolate bar. Jujubes gummi bears I
                                                                                    love powder danish oat cake tart
                                                                                    croissant.<a
                                                                                        href="javascript:void(0)">Reply</a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="people-box">
                                                                        <div>
                                                                            <div class="people-image">
                                                                                <img src="../assets/images/review/3.jpg"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="people-comment">
                                                                            <a class="name"
                                                                                href="javascript:void(0)">Gabrielle</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content">21 May, 2022 at
                                                                                    05.52 PM</h6>

                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class="reply">
                                                                                <p>Biscuit chupa chups gummies powder I love
                                                                                    sweet pudding jelly beans. Lemon drops
                                                                                    marzipan apple pie gingerbread macaroon
                                                                                    croissant cotton candy pastry wafer.
                                                                                    Carrot cake halvah I love tart caramels
                                                                                    pudding icing chocolate gummi bears.
                                                                                    Gummi bears danish cotton candy muffin
                                                                                    marzipan caramels awesome feel. <a
                                                                                        href="javascript:void(0)">Reply</a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                            <div class="">
                                                <a class="button-primary mb-5 d-block" href="{{ route('login') }}">Login to make review</a><br>
                                                <span class="text-extra">Don't have an account? <a href="{{ route('register') }}" class="button-secondary">create and account</a></span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="verndor-contain">
                                <div class="vendor-image">
                                    <img src="{{ $item->shop->image_path == null ? asset('assets/images/default1.jpg') : asset('uploads/logos/'.$item->shop->image_path) }}" class="blur-up lazyload" alt="">
                                </div>

                                <div class="vendor-name">
                                    <h5 class="fw-500">{{ $item->shop->name??'' }}</h5>

                                    <div class="product-rating mt-1">
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
                                        <span>(36 Reviews)</span>
                                    </div>

                                </div>
                            </div>

                            <p class="vendor-detail">{{$item->shop->description??''}}</p>

                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>Address: <span class="text-content">{{ $item->shop->contactInfo->location() }}</span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Trending Product -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>Other Products</h3>

                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    @foreach($item->shop->items()->take(10)->get() as $it)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('public.products.show', $it->slug) }}" class="offer-image">
                                                    <img src="{{ $it->featured_image ==  null ? asset('assets/images/default1.jpg') : asset('uploads/item_images/'.$it->featured_image) }}" class="img-fluid blur-up lazyload" alt="">
                                                </a>

                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('public.products.show', $it->slug) }}">
                                                            <h6 class="name">{{ $it->name??'' }}</h6>
                                                        </a>
                                                        {{-- <span>450 G</span> --}}
                                                        <h6 class="price theme-color">XAF {{ number_format($it->unit_price??0) }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Banner Section -->
                        <div class="ratio_156 pt-25">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h6 class="text-yellow home-banner">Seafood</h6>
                                        <h3 class="text-uppercase fw-normal"><span
                                                class="theme-color fw-bold">Freshes</span> Products</h3>
                                        <h3 class="fw-light">every hour</h3>
                                        <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->


    
    <!-- Sticky Cart Box Start -->
    <div class="sticky-bottom-cart shadow-md">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="cart-content">
                        <div class="product-image">
                        <img src="{{ $item->featured_image != null ? asset('uploads/item_images/'.$item->featured_image) : asset('assets/images/default1.jpg') }}" class="img-fluid blur-up lazyload"
                                alt="">
                            <div class="content">
                                <h5>{{ $item->name??'' }}</h5>
                                <h6>CFA {{ number_format($item->unit_price??0) }}</h6>
                            </div>
                        </div>
                        <div class="add-btn">
                            <a class="btn theme-bg-color text-white" href="tel:{{ $item->shop->contactInfo->phone??'' }}"><i class="fa fa-phone"></i> Call</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Cart Box End -->


@endsection
@section('script')
    <script>
        let imageChanged = function(event){
            
            var _files = event.target.files;

            if (parseInt(_files.length)>2){
                alert("You can only upload a maximum of 2 files");
                $(event.target).val(null);
                return;
            }
            let html = ``;
            // console.log(typeof _files);
            for (const key in _files) {
                if (Object.hasOwnProperty.call(_files, key)) {
                    const element = _files[key];
                    let _url = URL.createObjectURL(element);
                    html += `<img src="${_url}" style="width: 5rem; height: 5rem; border: 1px solid black; border-radius: 0.4rem; margin: 0.3rem 0.2rem;">`;
                }
            }
            $('#preview_box').html(html);
            
        }
        let reviewImageChanged = function(event){
            
            var _files = event.target.files;

            if (parseInt(_files.length)>2){
                alert("You can only upload a maximum of 2 files");
                $(event.target).val(null);
                return;
            }
            let html = ``;
            // console.log(typeof _files);
            for (const key in _files) {
                if (Object.hasOwnProperty.call(_files, key)) {
                    const element = _files[key];
                    let _url = URL.createObjectURL(element);
                    html += `<img src="${_url}" style="width: 5rem; height: 5rem; border: 1px solid black; border-radius: 0.4rem; margin: 0.3rem 0.2rem;">`;
                }
            }
            $('#review_preview_box').html(html);
            
        }
    </script>
@endsection