@extends('helep.general.master')
@section('page_title') @lang('general.shop_page_view',['shop'=>str_replace(" ","-",$shopDetails->name),'location'=>$shopDetails->shopContactInfo->address]) @endsection
@section('content')
    <div class="py-5 container-lg">
        <div class="row bg-white helep_round p-lg-4 ml-lg-n3 mr-lg-n5">
            <div class="col-md-12">
                @if(session('message'))
                    <div class="alert alert-success">{!! session('message') !!}</div>
                @endif
                <div class="clearfix"></div>
                <div class=" card">
                    <div class="row card-body">
                        <div class="col-md-9">
                            <div class="font-weight-bold text-black-50">
                                {{--                                <i class="zmdi zmdi-shopping-basket mr-1"></i>--}}
                                <div class="shop-avatar"
                                     style="height: 90px !important; background-color: #FAFAFA
 !important"><img class="p-2" alt="{{$shopDetails->name}}" style="max-height: 80px; max-width: 85px"
                  src="{{asset('storage/'.$shopDetails->image_path)}}">
                                    <a style="font-size: 18px !important;"
                                       href="{{route('show_shop_page',['id'=>$shopDetails->slug])}}">
                                        <span class="font-weight-bold text-capitalize">{{$shopDetails->name}}</span>
                                    </a>
                                </div>
                                <div class="pl-2"><p class="pl-3 ml-3"><i
                                            class="zmdi zmdi-pin p-2"></i>&nbsp;<small>{{$address}}</small></p></div>
                                <div class="ripple-container"></div>
                            </div>
                        </div>
                        <div class="col-md-3" style="float: right">
                            @php
                                $whatsappText = trans('general.whatsapp_shop_profile_intro_contact_msg',
                           ['shop'=>$shopDetails->name,
                           'link'=>urlencode(route('show_shop_page',['id'=>$shopDetails->slug]))]);
                            @endphp
                            @if(auth()->check() && auth()->user()->user_type==1)
                                @if(has_user_subscribed($shopDetails->id,auth()->user()->id))
                                    <a href="{{route('unsubscribe_shop',['user'=>auth()->user()->id,'shop'=>$shopDetails->id])}}">
                                        <button class="btn helep_btn_raise text-uppercase">UnSubscribe</button>
                                        @else
                                            <a href="{{route('subscribe_shop',['user'=>auth()->user()->id,'shop'=>$shopDetails->id])}}">
                                                <button class="btn helep_btn_raise text-uppercase">Subscribe</button>
                                            </a>
                                        @endif
                                        @else
                                            <a href="{{route('login_page',['redirectTo'=>route('show_shop_page',['id'=>$shopDetails->slug])])}}">
                                                <button class="btn helep_btn_raise text-uppercase">Subscribe</button>
                                            </a>
                                        @endif
                                        <a id="whatsappNumber" target="_blank"
                                           href="https://wa.me/{{$shopDetails->shopContactInfo->whatsapp_number}}?text={{$whatsappText}}">
                                            <button type="button" class="btn helep_btn_raise text-lowercase"
                                                    style="background-color: #128c7e !important; font-size: 10px"><i
                                                    class="zmdi zmdi-whatsapp"></i>@lang('general.share_whatsapp_custom_quote_msg')
                                            </button>
                                        </a>
                        </div>
                    </div>
                </div>
                @if(isMobile())
                    <div class="row text-center" id="showSummaryBtn">
                        <div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <button onclick="showShopSummary()" class="btn helep_btn_raise text-capitalize">
                                    <i class="zmdi zmdi-menu"></i>View Business Summary
                                </button>
                            </div>
                            <div class="col-md-8"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-none" id="mShopDetailDiv">
                            <div class="card">
                                <div class="list-group">
                                    <a href="#"
                                       class="list-group-item list-group-item-action withripple helep-color text-white"><i
                                            class="zmdi zmdi-pages"></i>Shop Owner Details
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="#"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-account-o"></i>{{$shopDetails->user->name}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="email:{{$shopDetails->user->email}}"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-email"></i>{{$shopDetails->user->email}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="tel:{{$shopDetails->user->tel}}"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-phone"></i>{{$shopDetails->user->tel}}
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="list-group">
                                    <a href="{{route('show_shop_page',['id'=>$shopDetails->slug])}}"
                                       class="list-group-item list-group-item-action withripple helep-color text-white"><i
                                            class="zmdi zmdi-pages"></i>Shop Details
                                        <div class="ripple-container"></div>
                                    </a>

                                    <a href="{{route('show_shop_page',['id'=>$shopDetails->slug])}}"
                                       class="list-group-item list-group-item-action withripple font-weight-bold text-black-50"><i
                                            class="zmdi zmdi-account-o"></i>{{$shopDetails->name}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-pin"></i>{{$shopDetails->shopContactInfo->address}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-calendar-account"></i>Shop created: <span
                                            class=" pl-2 text-black-50">
                                {{$shopDetails->shopContactInfo->created_at->diffForHumans()}}
                            </span>
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="tel:+{{$shopDetails->shopContactInfo->tel}}"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-phone"></i>Phone: <span
                                            class=" pl-2 text-black-50">
                                {{$shopDetails->shopContactInfo->tel}}
                            </span>
                                        <div class="ripple-container"></div>
                                    </a>

                                    <a href="{{$shopDetails->shopContactInfo->facebook_link}}" target="_blank"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-facebook"></i>Facebook : <span
                                            class=" pl-2 text-black-50">
                                {{$shopDetails->shopContactInfo->facebook_link}}
                            </span>
                                        <div class="ripple-container"></div>
                                    </a>
                                    @if($shopDetails->shopContactInfo->instagram_link)
                                        <a href="{{$shopDetails->shopContactInfo->instagram_link}}" target="_blank"
                                           class="list-group-item list-group-item-action withripple"><i
                                                class="zmdi zmdi-instagram"></i>Instagram: <span
                                                class=" pl-1 text-black-50">
                                            {{$shopDetails->shopContactInfo->instagram_link}}
                                        </span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            @include('generalmodule::components.product_list',['category'=>$shopDetails->category ?$shopDetails->category->category: '','products'=>$products,'subCategories'=>$subCategories])
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-3 ">
                            <div class="card">
                                <div class="list-group">
                                    <a href="#"
                                       class="list-group-item list-group-item-action withripple helep-color text-white"><i
                                            class="zmdi zmdi-pages"></i>Shop Owner Details
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="#"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-account-o"></i>{{$shopDetails->user->name}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="email:{{$shopDetails->user->email}}"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-email"></i>{{$shopDetails->user->email}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="tel:{{$shopDetails->user->tel}}"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-phone"></i>{{$shopDetails->user->tel}}
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="list-group">
                                    <a href="{{route('show_shop_page',['id'=>$shopDetails->slug])}}"
                                       class="list-group-item list-group-item-action withripple helep-color text-white"><i
                                            class="zmdi zmdi-pages"></i>Shop Details
                                        <div class="ripple-container"></div>
                                    </a>

                                    <a href="{{route('show_shop_page',['id'=>$shopDetails->slug])}}"
                                       class="list-group-item list-group-item-action withripple font-weight-bold text-black-50"><i
                                            class="zmdi zmdi-account-o"></i>{{$shopDetails->name}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-pin"></i>{{$shopDetails->shopContactInfo->address}}
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-calendar-account"></i>Shop created: <span
                                            class=" pl-2 text-black-50">
                                {{$shopDetails->shopContactInfo->created_at->diffForHumans()}}
                            </span>
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a href="tel:+{{$shopDetails->shopContactInfo->tel}}"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-phone"></i>Phone: <span
                                            class=" pl-2 text-black-50">
                                {{$shopDetails->shopContactInfo->tel}}
                            </span>
                                        <div class="ripple-container"></div>
                                    </a>

                                    <a href="{{$shopDetails->shopContactInfo->facebook_link}}" target="_blank"
                                       class="list-group-item list-group-item-action withripple"><i
                                            class="zmdi zmdi-facebook"></i>Facebook : <span
                                            class=" pl-2 text-black-50">
                                {{$shopDetails->shopContactInfo->facebook_link}}
                            </span>
                                        <div class="ripple-container"></div>
                                    </a>
                                    @if($shopDetails->shopContactInfo->instagram_link)
                                        <a href="{{$shopDetails->shopContactInfo->instagram_link}}" target="_blank"
                                           class="list-group-item list-group-item-action withripple"><i
                                                class="zmdi zmdi-instagram"></i>Instagram:
                                            <span
                                                class=" pl-1 text-black-50">
                                                {{$shopDetails->shopContactInfo->instagram_link}}
                                            </span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            @include('generalmodule::components.product_list',['category'=>$shopDetails->category ?$shopDetails->category->category: '','products'=>$products,'subCategories'=>$subCategories])
                        </div>
                    </div>
                @endif
                <div class="row card">
                    <div class="col-md-12 card-body">
                        <div>
                            <h4 class="text-black-50 font-weight-bold">Customer Reviews ({{count($reviews)}})</h4>
                        </div>
                        @include('generalmodule::components.shop_review_list',['reviews'=>$reviews,'reviewImages'=>$reviewImages])

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-5">
                                {{ $reviews->links() }}
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 574px ) {
            .img-caroul {
                max-width: 200px !important;
                width: 200px !important;
            }
        }
    </style>
@endsection
@section('js')
    <script>
        function showShopSummary() {
            $('#mShopDetailDiv').toggleClass("d-block");
        }
    </script>
@endsection
