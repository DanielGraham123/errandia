@extends('public.layout')
@section('style')
    <style>
        .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        }

        .rating > input{ display:none;}

        .rating > label {
        position: relative;
            width: 1em;
            font-size: 3vw;
            color: #FFD600;
            cursor: pointer;
        }
        .rating > label::before{ 
        content: "\2605";
        position: absolute;
        opacity: 0;
        }
        .rating > label:hover:before,
        .rating > label:hover ~ label:before {
        opacity: 1 !important;
        }

        .rating > input:checked ~ label:before{
        opacity:1;
        }

        .rating:hover > input:checked ~ label:before{ opacity: 0.4; }

        /* body{ background: #222225; color: white;} */
        h1, p{ 
            text-align: center;
            
        }

        h1{
            margin-top:150px;
        }
        p{ font-size: 1.2rem;}
        @media only screen and (max-width: 600px) {
        h1{font-size: 14px;}
        p{font-size: 12px;}
        }

    </style>
@endsection     
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
                <div class="col-xxl-6 col-xl-6 col-lg-7 wow fadeInUp">
                    <div class="p-4">
                       
                        <div class=" wow fadeInUp" data-wow-delay="0.1s">
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


                                <div class="note-box product-packege">
                                   
                                    <button onclick="location.href = `https://wa.me/{{ $item->shop->contactInfo->whatsapp??'' }}`;"
                                        class="btn btn-md bg-success cart-button text-white w-100"><i class="fa fa-whatsapp mr-2 d-inlineblock"></i> &nbsp; Chat on WhatsApp</button>

                                    <button onclick="location.href = `tel:{{ $item->shop->contactInfo->phone }}`"
                                        class="btn btn-md bg-dark cart-button text-white w-100"><i class="fa fa-phone mr-2 d-inlineblock"></i> &nbsp; Call</button>
                                </div>
                               
                            </div>
                        </div>

                        <div class=" wow fadeInUp my-5">
                            <div class="product-left-box">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <form enctype="multipart/form-data" method="post">
                                            @csrf
                                            <div class="row g-4">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-floating theme-form-floating">
                                                        <div class="rating">
                                                            <div class="rating">
                                                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                                            </div>
                                                        </div>
                                                        <label for="floatingTextarea2">Rating</label>
                                                            
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-floating theme-form-floating">
                                                        <div class="input-images"></div>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-12">
                                                    <div class="form-floating theme-form-floating">
                                                        <textarea class="form-control" placeholder="Leave your review here" id="floatingTextarea2" name="review" required style="height: 150px">{{ old('review') }}</textarea>
                                                        <label for="floatingTextarea2">Write Your
                                                            review</label>
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
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-xl-6 col-lg-5 d-none d-lg-block wow fadeInUp">
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
        $('.input-images').imageUploader();


    </script>

    

@endsection