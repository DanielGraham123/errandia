@extends('b_admin.layout')
@section('section')
    <div class="container">
        <span class="d-block my-3 text-h6">Errand Details</span>
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="border bg-white shadow-md p-5 m-3" style="border-radius: 0.6rem;">
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Title</span>
                        <span class="col-sm-9 text-h6 text-capitalize">{{ $errand->title??'' }}</span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Description</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->description??'' }}</span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">categories</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ implode(', ', $errand->_categories()->pluck('name')->toArray()) }}</span>
                    </div>
                </div>

                {{-- @dd($errand) --}}
                <div class=" wow fadeInUp">
                    <div class="product-left-box">
                        <div class="row g-2">
                            <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                <div class="product-main-2 no-arrow">
                                    @foreach($errand->images as $key=>$img)
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ asset('uploads/quote_images/'.$img->image) }}" id="img-1"
                                                    data-zoom-image="{{  asset('uploads/quote_images/'.$img->image) }}"
                                                    class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    @endforeach

                                    
                                </div>
                            </div>

                            <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                    @foreach($errand->images as $key=>$img)
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ asset('uploads/quote_images/'.$img->image) }}" id="img-1"
                                                    data-zoom-image="{{ asset('uploads/quote_images/'.$img->image) }}"
                                                    class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 ">
                <div class="border bg-white shadow-md p-5 m-3" style="border-radius: 0.6rem;">
                    <span class="h5" style="color: var(--color-darkblue);">Posted By</span>
                    <span class="d-block"><img style="width: 6rem; height 6rem; border-radius: 50%; border: 1px solid var(--color-darkblue);" src="{{ asset('assets/admin/images/admin-profile-pic.png') }}"> <span class="text-overline ml-3">{{ $errand->posted_by->name??'user' }}</span></span>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">phone</span>
                        <span class="col-sm-9 text-body text-capitalize">
                            @if(($errand->posted_by->phone??null) != null)
                                <a href="tel:{{ $errand->posted_by->phone }}" class="button-secondary d-block"> <span class="fa fa-phone"></span> Call</a> 
                                <a href="https://wa.me/{{ $errand->posted_by->phone }}" class="button-success d-block"> <span class="fa fa-whatsapp"></span> Whatsapp</a> 
                            @endif
                        </span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Email</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">
                            @if(($errand->posted_by->email??null) != null)
                               <a href="mailto: {{ $errand->posted_by->email }}" class="button-secondary d-block"> <span class="fa fa-message"></span> Write </a>  
                            @endif
                        </span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Location</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->location()??'' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection