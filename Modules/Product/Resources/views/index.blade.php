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

        {{--            @foreach($products->sortDesc()->chunk(3) as $chunk)--}}
        {{--                <div class="row card-deck mb-4 ">--}}
        {{--                    @foreach($chunk as $product)--}}
        {{--                        @php--}}
        {{--                            $length= 100;--}}
        {{--                             if (preg_match('/^.{1,'.$length.'}\b/su', $product->description, $match)) {--}}
        {{--                                      $description= $match[0]."...";--}}
        {{--                                 } else{--}}
        {{--                                    $description= $product->description;--}}
        {{--                             }--}}
        {{--                            $currency = $currencies->where('id',$product->currency_id)->first();--}}
        {{--                        @endphp--}}
        {{--                        <div class="col-md-4 col-sm-12 card  ms-feature helep_round col-lg-4 ">--}}
        {{--                            <div class="card-body overflow-hidden text-center">--}}
        {{--                                <div class="withripple zoom-img">--}}
        {{--                                    <a href="{{route('show_product',['id'=>$product->slug])}}">--}}
        {{--                                        <img style="max-height:200px;" height="200"--}}
        {{--                                             src="{{asset('storage/'.$product->featured_image_path)}}" alt=""--}}
        {{--                                             class=" rounded-lg  center-block"></a>--}}
        {{--                                </div>--}}
        {{--                                <h4 class="text-normal text-center">{{$product->name}}</h4>--}}
        {{--                                <br/>--}}
        {{--                                --}}{{--                        <p>{{$description}}</p>--}}
        {{--                                <span class="mr-2 mt-2">--}}
        {{--                        <i class="zmdi zmdi-star color-warning"></i>--}}
        {{--                        <i class="zmdi zmdi-star color-warning"></i>--}}
        {{--                        <i class="zmdi zmdi-star color-warning"></i>--}}
        {{--                        <i class="zmdi zmdi-star color-warning"></i>--}}
        {{--                        <i class="zmdi zmdi-star"></i>--}}
        {{--                      </span>--}}
        {{--                                <span class="ms-tag helep_btn_raise">{{$product->unit_price." ".$currency->name}}</span>--}}
        {{--                                <p class="card-text mt-1 pt-1">--}}
        {{--                                    <a href="{{route('edit_product',['id'=>$product->slug])}}"--}}
        {{--                                       class="text-muted"><i--}}
        {{--                                            class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>--}}
        {{--                                    <a href="{{route('delete_product',['id'=>$product->slug])}}"--}}
        {{--                                       class="text-muted pl-4"><i--}}
        {{--                                            class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>--}}
        {{--                                </p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    @endforeach--}}
        {{--                </div>--}}
        {{--            @endforeach--}}

        <table id="productTable" class="table-responsive table table-striped table-bordered nowrap">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Featured Product Image</th>
                <th>Name</th>
                <th>Short Summary</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @php $counter=1; @endphp
            @foreach($products->sortDesc() as $product)
                @php
                    $currency = $currencies->where('id',$product->currency_id)->first();
                @endphp
                <tr>
                    <td>{{$counter++}}</td>
                    <td>
                        <a href="{{route('show_product',['id'=>$product->slug])}}">
                            <img style="max-height:100px;max-width: 100px" height="100px"
                                 width="100px"
                                 src="{{asset('storage/'.$product->featured_image_path)}}" alt=""
                                 class=" rounded-lg  center-block"></a>
                    </td>
                    <td style="white-space: normal ">{{$product->name}}</td>
                    <td style="white-space: normal ">{{$product->summary}}</td>
                    <td><span class="ms-tag helep_btn_raise">{{number_format($product->unit_price)." ".$currency->name}}</span>
                    </td>
                    <td>
                        <a href="{{route('show_product',['id'=>$product->slug])}}" class="text-muted">
                            <i class="fa fa-eye text-info"></i>&nbsp;{{trans('admin.view_msg')}}
                        </a>
                        <a href="{{route('edit_product',['id'=>$product->slug])}}" class="text-muted p-1 m-1"><i
                                class=" fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                        <a href="{{route('delete_product',['id'=>$product->slug])}}" class="text-muted"><i
                                class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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

