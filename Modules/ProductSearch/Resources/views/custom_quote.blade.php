@extends('helep.general.master')
@section('content')
    <div class="py-5 container-lg card">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-bottom:30px;">
                <h3><b>@lang("general.errands_custom_view_request")</b></h3>
            </div>
            <div class="col-md-6 col-sm-12">
                <div id="carousel-product" class="ms-carousel ms-carousel-thumb carousel slide" data-ride="carousel"
                     data-interval="0">
                    <div class="card ">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner card-body" role="listbox">
                            <div class="carousel-item active withripple zoom-img">
                                <img class="p-lg-5  ml-lg-5 img-caroul" style="max-height: 345px;"
                                     src="{{asset('storage/'.$featured_image->image_path)}}" alt="Featured quote image">
                            </div>
                            @foreach($quote->images as $image)
                                <div class="carousel-item withripple zoom-img">
                                    <img class="p-lg-5 m-lg-5 img-caroul" style="max-height:345px;"
                                         src="{{asset('storage/'.$image->image_path)}}"
                                         alt="Product Quote Image">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Indicators -->
                    <ol class="carousel-indicators carousel-indicators-tumbs carousel-indicators-tumbs-outside">
                        <li data-target="#carousel-product" data-slide-to="0" class="active helep_round">
                            <img height="80" width="95" src="{{asset('storage/'.$featured_image->image_path)}}"
                                 alt="">
                        </li>
                        @php
                            $counter =0;
                        @endphp
                        @foreach($quote->images as $image)
                            @php
                                ++$counter;
                            @endphp
                            <li data-target="#carousel-product" class="helep_round" data-slide-to="{{$counter}}">
                                <img height="80" width="95" src="{{asset('storage/'.$image->image_path)}}"
                                     alt="Product Image">
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="font-weight-bold text-black-50">{{$quote->title}}</h4>
                        <br/>
                        <p class="lead font-16">{!!$quote->description!!}</p>
                        <ul class="list-unstyled">
                            <li>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-bg">
                                        <li class="breadcrumb-item shadow-2dp active"><span
                                                class="text-black font-10">@lang('vendor.product_view_category_msg') </span>
                                        </li>
                                        <li class="breadcrumb-item"><a class="helep_btn_raise"
                                                href="{{route('show_cat_products',['category'=>$quote->category->category->slug])}}">{{$quote->category->category->name}}</a></li>
                                        <li class="breadcrumb-item"><a class="helep_btn_raise"
                                                href="{{route('show_collection_products',['category'=>$quote->category->slug])}}">{{$quote->category->name}}</a></li></ol>
                                </nav>
                            </li>
                            <li class="">
                                <a id="phone" class="btn helep_btn_raise"
                                   href="tel:{{$quote->phone_number}}">Contact Requester
                                </a>
{{--                                <span--}}
{{--                                    class="text-black-50">@lang('general.view_quote_client_number') </span> <span--}}
{{--                                    class="ms-tag ms-tag-success"><a href="tel:{{$quote->phone_number}}">{{$quote->phone_number}}</a></span>--}}
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
