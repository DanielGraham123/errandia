@extends('helep.vendor.layout.master')
@section('page_title') @lang('vendor.product_list_page_title') @endsection
@section('title') @lang('vendor.product_list_page_title',['name'=>$shop->name]) @endsection
@section('content')
    <div class="container py-2">
           <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"><a href="{{route('add_product')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('vendor.add_product_btn_label')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <div class="clearfix"><br/></div>
        @if(!$products->isEmpty())
            <div class="row">

                    @foreach($products->sortDesc() as $product)
                    <div class="col-md-6">
                        @include('product::partials.product_card',['product'=>$product])
                    </div>
                    @endforeach

            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    {{ $products->links() }}
                </div>
                <div class="col-md-2"></div>
            </div>

        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <h5>No product found</h5>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section("css")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('js')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(function () {
            //set link indicator
            $("#vendor_manage_product").addClass('active');
            $('#productTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection

