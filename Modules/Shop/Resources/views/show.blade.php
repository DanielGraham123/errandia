@extends('helep.admin.layout.master')
@section('page_title') @lang('shop.show_shops_title',['name'=>$shop->name]) @endsection
@section('title') @lang('shop.show_shops_title',['name'=>$shop->name]) @endsection
@php
    $default_shop_avatar = md5(strtolower(trim($shop->user->email)));
    $shop_image= (!is_null($shop->image_path) && $shop->image_path !="") ? asset('storage/'.$shop->image_path) : "https://www.gravatar.com/avatar/".$default_shop_avatar;
@endphp
@section('content')
    <div class="clearfix"><br/></div>
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap">
                <a href="{{route('shop_list')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <div class="row my-5">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-lg-12 col-md-6 order-md-1">
                        <div class="card helep_round">
                            <div class="ms-hero-bg-primary ms-hero-img-coffee">
                                <h3 class="color-white index-1 text-center no-m pt-4">{{$shop->user->name}}</h3>
                                <div class="color-medium index-1 text-center np-m">{{ $shop->user->email }}</div>
                                <img src="{{$shop_image}}" alt="..."
                                     class="img-avatar-circle mt-n4">
                            </div>
                            <div class="card-body pt-4 text-center">
                                <h3 class="color-primary">{{$shop->name}}</h3>
                                <p>{!! $shop->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card helep_round  card-body overflow-hidden text-center">
                            <h2 class="counter">{{$shop->products->count()}}</h2>
                            <i class="fa fa-4x fa-file-text"></i>
                            <p class="mt-2 no-mb lead small-caps ">@lang('shop.shop_info_products')</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div
                            class="card helep_round card-body overflow-hidden text-center">
                            <h2 class="counter">0</h2>
                            <i class="fa fa-4x fa-briefcase "></i>
                            <p class="mt-2 no-mb lead small-caps ">@lang('shop.shop_info_orders')</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div
                            class="card helep_round card-body overflow-hidden text-center">
                            <h2 class="counter">0</h2>
                            <i class="fa fa-4x fa-money-bill-alt"></i>
                            <p class="mt-2 no-mb lead small-caps">@lang('shop.shop_info_refunds')</p>
                        </div>
                    </div>
                </div>
                <div class="card card-light helep_round">
                    <div class="card-header">
                        <h3 class="card-title">@lang('shop.shop_info_general_title')</h3>
                    </div>
                    <table class="table table-no-border table-striped">
                        <tr>
                            <th>
                                <i class="zmdi zmdi-face mr-1 color-success"></i>@lang('shop.add_shop_placeholder_full_name')
                            </th>
                            <td>{{$shop->user->name}}</td>
                        </tr>
                        <tr>
                            <th><i class="zmdi zmdi-account mr-1 color-warning"></i>@lang('shop.shop_list_category_msg')
                            </th>
                            <td>
                                @if(sizeof($shop->categories))
                                    @foreach($shop->categories as $key=>$category)
                                        {{$category->name}}
                                        @if($key < sizeof($shop->categories) -1)
                                            {{','}}
                                        @endif
                                    @endforeach
                                @elseif($shop->category)
                                    {{$shop->category->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="zmdi zmdi-my-location mr-1 color-danger"></i> @lang('shop.add_shop_placeholder_address')
                            </th>
                            <td><a>{{$address}}</a></td>
                        </tr>
                        <tr>
                            <th><i class="zmdi zmdi-link mr-1 color-info"></i>@lang('shop.add_shop_placeholder_website')
                            </th>
                            <td><a target="_blank"
                                   href="{{$shop->shopContactInfo->website_link}}">{{$shop->shopContactInfo->website_link}}</a>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="zmdi zmdi-calendar mr-1 color-royal"></i>@lang('shop.shop_info_reg_date_msg')
                            </th>
                            <td>{{$shop->created_at->diffForHumans()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_shops").addClass('active');
        });
    </script>
@endsection
