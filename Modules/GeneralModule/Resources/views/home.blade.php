@extends('helep.general.master')

@section('content')
    <div class="py-5 container">
        <div class="ml-lg-n2 mr-lg-n5">
            <div class="row">
                <div class="col-md-2 card">
                    <div class="card-body">

                    </div>
                </div>
                <div class="col-md-8 rounded-lg radius-15">
                    @include('helep.general.components.advert_slider')
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-media-list">
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-question-circle color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;" class="mt-0 mb-0">SUPPORT CENTER</h6>
                                        <a style="font-size: 12px !important;">Customer Care?</a>
                                    </div>
                                </div>
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-question-circle color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;" class="mt-0 mb-0">REFUND POLICY</h6>
                                        <a style="font-size: 12px !important;">Quick return</a>
                                    </div>
                                </div>
                                <div class="media mb-2">
                                    <a class="mr-1"><i style="font-size: 22px"
                                                       class="fa fa-exchange-alt color-black"></i></a>
                                    <div class="media-body">
                                        <h6 style="font-size: 11px !important;" class="mt-0 mb-0">SELL ON HELEP</h6>
                                        <a style="font-size: 12px !important;">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <img style="max-height: 100px; width: 100%" src="{{asset('images/helep 1.png')}}"
                                 class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            {{--         Trending products--}}
            <div class="row card helep_alert_round">
                <div class=" card-body col-md-12">
                    {!! $trendingProducts !!}
                    <div class="clearfix">
                        <hr/>
                    </div>
                    {!! $featureCategoryProducts !!}
                </div>
            </div>
            {{--                   Category and featured collections divs--}}
            <div class="row card helep_alert_round">
                <div class="card-body col-md-12">
                    @includeWhen($collections->count()>0,'helep.general.components.collection_list',['collections'=>$collections])
                </div>
            </div>
            {{--            featured sub categories--}}
            <div class="row card helep_alert_round mb-3">
                <div class="card-body col-md-12">
                    @includeWhen($categories->count()>0,'helep.general.components.category_list',['categories'=>$categories])
                </div>
            </div>
            {{--             Popular shops--}}
            <div class="clearfix"><br/></div>
            <div class="bg-helep-blue">
                <div class="container">
                    {!! $featuredShops !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/carousel.js')}}"></script>
@endsection
