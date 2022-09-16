@extends('helep.vendor.layout.master')
@section('page_title') @lang('vendor.product_item_view',['name'=>str_replace(" ","-",$product->name)]) @endsection
@section('title') @lang('vendor.product_item_view',['name'=>$product->name]) @endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap"><a href="{{route('products')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <div>
            <div class="clearfix"><br/></div>
            @include('product::partials.product_details')
            <div class="clearfix mb-4"></div>
            @includeWhen($otherShopProducts->count()>0,'product::partials.scrollable_product_list',['shopProducts'=>$otherShopProducts,'title'=>trans('vendor.shop_products_list_msg'),'product_route_name'=>'show_product'])
            <div class="clearfix mb-4"></div>
            @includeWhen($otherProductsCategory->count()>0,'product::partials.scrollable_product_list',['shopProducts'=>$otherProductsCategory,'product_route_name'=>'show_product','title'=>trans('vendor.category_products_list_msg',['category'=>$product->subCategory->name])])
        </div>
    </div>
    <style>
        @media (max-width: 574px ) {
            .img-caroul {
                max-width: 200px !important;
            }
        }
    </style>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#vendor_manage_product").addClass('active');
        });
    </script>
@endsection
