@extends('helep.general.master')
@section('page_title') @lang('vendor.product_item_view',['name'=>str_replace(" ","-",$product->name)]) @endsection
@section('title') @lang('vendor.product_item_view',['name'=>$product->name]) @endsection
@section('content')
    <div class="py-5 container-lg">
        <div class="row bg-white helep_round p-lg-4 ml-lg-n3 mr-lg-n5">
            <div class="col-md-12">
                <div class="clearfix"><br/></div>
                @include('helep.general.components.product_details')
                <div class="clearfix mb-4"></div>
                @includeWhen($otherShopProducts->count()>0,'product::partials.scrollable_product_list',['shopProducts'=>$otherShopProducts,'title'=>trans('vendor.shop_products_list_msg'),'product_route_name'=>'general_product_details'])
                <div class="clearfix mb-4"></div>
                @includeWhen($otherProductsCategory->count()>0,'product::partials.scrollable_product_list',['shopProducts'=>$otherProductsCategory,'product_route_name'=>'general_product_details','title'=>trans('vendor.category_products_list_msg',['category'=>$product->subCategory->name])])
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
