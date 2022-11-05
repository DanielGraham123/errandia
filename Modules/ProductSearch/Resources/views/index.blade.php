@extends('helep.general.master')
@section('content')
    <div class="py-5 container-lg">
        <div class="text-center" style="margin-bottom:30px;">
            <h3 class="text-black-50 font-weight-bold"><b>Search result for "{{$keyword}}"</b></h3>
        </div>
        <div class="row">
            <div class="col-md-3  card">
                <h4>Sort By </h4>
                <div class="desktop-only">
                    <form method="get" action="{{route('productsearch')}}">

                        {{--                        {{ csrf_field() }}--}}
                        <input type="hidden" name="search" value="{{$keyword}}"/>
                        <select class="form-control" name="region" id="regionSearch" onchange="this.form.submit();">
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                                <option
                                    value="{{$region->id}}" <?php echo $region->id == request('region') ? 'selected="selected"' : '';?>>{{$region->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="town" id="townSearch" onchange="this.form.submit();">
                            <option value="">Select Town</option>
                            @foreach($towns as $town)
                                <option value="{{$town->id}}" <?php echo $town->id == request('town') ? 'selected="selected"' : '';?>>{{$town->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="street" id="streetSearch" onchange="this.form.submit();">
                            <option value="">Select Street</option>
                            @foreach($streets as $street)
                                <option value="{{$street->id}}" <?php echo $street->id == request('street') ? 'selected="selected"' : '';?>>{{$street->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="mobile-only">
                    <form method="GET" action="{{route('productsearch')}}">

{{--                        {{ csrf_field() }}--}}
                        <input type="hidden" name="search" value="{{$keyword}}"/>
                        <select class="form-control" name="region" id="regionSearch" onchange="this.form.submit();">
                            <option value="">Region</option>
                            @foreach($regions as $region)
                                <option
                                    value="{{$region->id}}" <?php echo $region->id == request('region') ? 'selected="selected"' : '';?>>{{$region->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control mx-3" name="town" id="townSearch" onchange="this.form.submit();">
                            <option value="">Town</option>
                            @foreach($towns as $town)
                                <option value="{{$town->id}}" <?php echo $town->id == request('town') ? 'selected="selected"' : '';?>>{{$town->name}}</option>
                            @endforeach
                        </select>

                        <select class="form-control" name="street" id="streetSearch" onchange="this.form.submit();">
                            <option value="">Street</option>
                            @foreach($streets as $street)
                                <option value="{{$street->id}}" <?php echo $street->id == request('street') ? 'selected="selected"' : '';?>>{{$street->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            {{--            <div class="col-md-9  card">--}}
            {{--                {{$products}}--}}
            {{--            </div>--}}
            <div class="col-md-9 card">
                @if(!$products->isEmpty())
                    <a href="{{route('run_errand_page')}}" class="btn helep_btn_raise">Send Custom Product Quote</a>
                    <div class="card helep-color" style="margin-top:15px;">
                        <div class="row card-body">
                            <div class="col-md-12">
                                <div class="m-2">
                                    <h4 class="index-2 pl-2 text-center text-white font-weight-bold  pb-2 mb-2 text-capitalize">
                                        {{$TotalProducts}} Products found !<small></small></h4>
                                </div>
                                @php
                                    $column="col-md-3";
                                    $card_shadow ="";
                                     $i=0;
                                @endphp
                                <div class="row">

                                    @foreach($products as $product)
                                        @php
                                            $length= 30;
                                                 if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                                                          $name= $match[0]."...";
                                                     } else{
                                                        $name= $product->name;
                                                 }
                                        @endphp

                                        <div class="{{$column}} {{$card_shadow}} mb-2">
                                            <div class="card h-100 w-100 mb-0">
                                                <div class="card-body withripple zoom-img">
                                                    <a href="{{route('general_product_details',['id'=>$product->slug])}}">
                                                        @if(isMobile())
                                                            <img
                                                                style="width:280px; max-width:280px; height:251px; max-height:251px"
                                                                class="img-fluid center-block"
                                                                src="{{asset('storage/'.$product->featured_image_path)}}"/>
                                                        @else
                                                            <img height="130px" class="card-img-top"
                                                                 src="{{asset('storage/'.$product->featured_image_path)}}"/>
                                                        @endif

                                                        <div class="card-title mt-1">
                                                            <h5
                                                                class="text-black font-weight-bolder text-center">
                                                                {{$name}}
                                                            </h5>
                                                        </div>
                                                    </a>
                                                    @if($product->unit_price)
                                                        <div class="card-text"><h4
                                                                class="font-weight-bold pb-1 mb-0 text-muted helep-text-color text-center">{{$product->currency}} {{$product->unit_price}}</h4>
                                                        </div>
                                                    @endif

                                                    <div class="card-header mb-1">

                                                        <h5
                                                            class="font-weight-bold text-black text-center">{{$product->shop_name}}</h5>
                                                    </div>

                                                    <div class="card-text mb-1"><h6
                                                            class="m-0 text-muted text-center">{{$product->shop_address}}</h6>
                                                    </div>
                                                    <div class="card-text">
{{--                                                        <a href="tel:{{$product->shop_tel}}">--}}
{{--                                                            <h6--}}
{{--                                                                class="m-0 p-0 text-black text-center">{{$product->shop_tel}}</h6>--}}
{{--                                                        </a>--}}
                                                        <a href="tel:{{$product->shop_tel}}"
                                                           class="btn helep_btn_raise w-100" style="padding: 8px 0px;"><i
                                                                class="zmdi zmdi-phone"></i>Contact shop
                                                            <div class="ripple-container"></div>
                                                        </a>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>


                                                                {!! $products->appends(['search' => $keyword,'town'=>request('town'),'region'=>request('region'),'street'=>request('street')])->links() !!}
                            </div>
                            <style>
                                @media (min-width: 992px) {
                                    .product-image-size {
                                        width: 540px;
                                    }
                                }
                            </style>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger helep_alert_round" style="margin-top:50px;">No product
                        found!
                    </div>
                @endif

                @if(!$shops->isEmpty())
                    <div class="card box-shadow-none bg-light-gray">
                        <div class="row card-body">
                            <div class="text-left col-md-12 mb-1">

                                    <h4 class="font-weight-bold text-black-50">Errandia Suggest the following businesses</h4>

                            </div>

                            @php
                                $colum_size ="col-md-3";
                            @endphp
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($shops->sortBy('name')->take(8) as $shop)


                                        <div class="{{$colum_size}} mb-2">
                                            <div class="card h-100 mb-0">
                                                <div class="card-body">
                                                    <a href="{{route('show_shop_page',['id'=>$shop->slug])}}">
                                                        <img src="{{asset('storage/'.$shop->image_path)}}"
                                                             style="width:100% ;max-height: 150px;max-width:100%" alt=""
                                                             class="img-fluid">


                                                        <div class="text-center">
                                                                                                    <a href="{{route('show_shop_page',['id'=>$shop->slug])}}">
                                                            <h5 class="text-black font-weight-bold text-capitalize">{{$shop->name}}</h5>
                                                                                                    </a>
                                                            <h5 class="text-black">
                                                                <i class="zmdi zmdi-pin"></i>
                                                                <span>{{$shop->store_street}}, {{$shop->store_town}} {{$shop->store_region}}</span>
                                                            </h5>
                                                            <a href="tel:{{$shop->shop_tel}}"
                                                               class="btn helep_btn_raise w-100" style="padding: 8px 0px;"><i
                                                                    class="zmdi zmdi-phone"></i>Contact shop
                                                                <div class="ripple-container"></div>

                                                            </a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var QuoteImageCounter = 0;

        function previewProduct(obj, img_id) {
            var file = $("#" + obj.id).get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#' + img_id).removeClass('d-none');
                    $("#" + img_id).attr("src", reader.result);
                    QuoteImageCounter++;
                    $('#QuoteImageCounter').val(QuoteImageCounter);
                }
                $('#' + obj.id).addClass('helep_round');
                reader.readAsDataURL(file);
            }
        }

        function getSubCategoriesByCategory(obj) {
            if (obj.id === "dialog_category") {
                var category = $("#dialog_category").val();
            } else {
                var category = $("#category").val();
            }
            if (category === "none") return;
            $("#sub_category").html("<option value='none'>Please Wait ....</option>");
            $.ajax({
                datatype: "json",
                type: 'get',
                data: {
                    category: category
                },
                url: $("#baseUrl").val() + '/categories/subcategories/category',
                success: function (response) {
                    var res = JSON.parse(response);
                    if (obj.id === "dialog_category") {
                        $("#sub_dialog_category").html(res.data);
                        $('#sub_dialog_category option[value="<?php echo request('sub_category');?>"]').attr("selected", "selected");
                    } else {
                        $("#sub_category").html(res.data);
                        $('#sub_category option[value="<?php echo request('sub_category');?>"]').attr("selected", "selected");
                    }
                },
                error: function () {
                    console.log("Eror getting response");
                }
            });
        }

        $(function () {
            setTimeout(getSubCategoriesByCategory, 1000);
            var region = $("#regionSearch").val();
            if (region)
                setTimeout(getTowns, 1000);
        });

        function getTowns() {
            var region = $("#regionSearch").val();
            if (region === "none") return;
            $("#town").html("<option value='none'>Please Wait ....</option>");
            {{--$.ajax({--}}
            {{--    datatype: "json",--}}
            {{--    type: 'get',--}}
            {{--    data: {--}}
            {{--        region: region--}}
            {{--    },--}}
            {{--    url: $("#baseUrl").val() + '/region/town',--}}
            {{--    success: function (response) {--}}
            {{--        var res = JSON.parse(response);--}}
            {{--        $("#townSearch").html(res.data);--}}
            {{--        $('#townSearch option[value="<?php echo request('town');?>"]').attr("selected", "selected");--}}
            {{--        setTimeout(getStreets, 500);--}}
            {{--    },--}}
            {{--    error: function () {--}}
            {{--        console.log("Eror getting response");--}}
            {{--    }--}}
            {{--});--}}
        }

        function getStreets() {

            var town = $("#townSearch").val();
            if (town === "none") return;
            $("#streetSearch").html("<option value='none'>Please Wait ....</option>");
            {{--$.ajax({--}}
            {{--    datatype: "json",--}}
            {{--    type: 'get',--}}
            {{--    data: {--}}
            {{--        town: town--}}
            {{--    },--}}
            {{--    url: $("#baseUrl").val() + '/town/street',--}}
            {{--    success: function (response) {--}}
            {{--        var res = JSON.parse(response);--}}
            {{--        $("#streetSearch").html(res.data);--}}
            {{--        $('#streetSearch option[value="<?php echo request('street');?>"]').attr("selected", "selected");--}}
            {{--    },--}}
            {{--    error: function () {--}}
            {{--        console.log("Eror getting response");--}}
            {{--    }--}}
            {{--});--}}
        }

    </script>
@endsection
