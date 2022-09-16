@extends('helep.general.master')
@section('page_title')@lang('general.home_page_title')@endsection
@section('content')
    <div class="py-5 container-lg">
        <div class="mr-lg-n5">
            <div class="row">
                <div class="col-md-2 card">
                    <div class="card-body">
                    </div>
                </div>
                <div class="col-md-8 rounded-lg radius-15">
                    @include('helep.general.components.advert_slider')
                </div>
                <div class="col-md-2 card">
                    <div>
                        <div class="card-body">
                            <div class="ms-media-list">
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-support color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;"
                                            class="mt-0 mb-0">@lang('general.home_header_title_1')</h6>
                                        <a style="font-size: 12px !important;">@lang('general.home_header_title_2')</a>
                                    </div>
                                </div>
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-phone color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;"
                                            class="mt-0 mb-0">@lang('general.home_header_title_3')</h6>
                                        <a style="font-size: 12px !important;">@lang('general.home_header_title_4')</a>
                                    </div>
                                </div>
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-address-book color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;"
                                            class="mt-0 mb-0">@lang('general.home_header_title_5')</h6>
                                        <a style="font-size: 12px !important;">@lang('general.home_header_title_6')</a>
                                    </div>
                                </div>
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-location-arrow color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;"
                                            class="mt-0 mb-0">@lang('general.home_header_title_7')</h6>
                                        <a style="font-size: 12px !important;">@lang('general.home_header_title_8')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="card">--}}
{{--                        <div>--}}
{{--                            <img style="max-height: 80px; width: 100%" src="{{asset('images/helep 1.png')}}"--}}
{{--                                 class="img-fluid">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

            <div class="row card helep_alert_round">
                <div class="card-body col-md-12">
                    @includeWhen($categories->count()>0,'helep.general.components.home_category_menu',['categories'=>$categories])
                </div>
            </div>
            {{-- Popular shops--}}
            <div class="clearfix"><br/></div>
            <div class="container-fluid ">
                <div class="bg-helep-blue">
                    {!! $featuredShops !!}
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('js')--}}
{{--    <script src="{{asset('js/carousel.js')}}"></script>--}}
{{--@endsection--}}
