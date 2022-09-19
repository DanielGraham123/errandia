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

                        {{ csrf_field() }}
                        <input type="hidden" name="keyword" value="{{$keyword}}"/>
                        <select class="form-control" name="region" id="regionSearch" onchange="this.form.submit();">
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                                <option
                                    value="{{$region->id}}" <?php echo $region->id == request('region') ? 'selected="selected"' : '';?>>{{$region->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="town" id="townSearch" onchange="getStreets(this)">
                            <option value="">Select Town</option>
                            @foreach($towns as $town)
                                <option value="{{$town->id}}">{{$town->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="street" id="streetSearch">
                            <option value="">Select Street</option>
                            @foreach($streets as $street)
                                <option value="{{$street->id}}">{{$street->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="mobile-only">
                    <form method="POST" action="{{route('productsort')}}">

                        {{ csrf_field() }}
                        <input type="hidden" name="keyword" value="{{$keyword}}"/>
                        <select class="form-control" name="region" id="regionSearch" onchange="getTowns(this)">
                            <option value="">Region</option>
                            @foreach($regions as $region)
                                <option
                                    value="{{$region->id}}" <?php echo $region->id == request('region') ? 'selected="selected"' : '';?>>{{$region->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control mx-3" name="town" id="townSearch" onchange="getStreets(this)">
                            <option value="">Town</option>
                            @foreach($towns as $town)
                                <option value="{{$town->id}}">{{$town->name}}</option>
                            @endforeach
                        </select>

                        <select class="form-control" name="street" id="streetSearch">
                            <option value="">Street</option>
                            @foreach($streets as $street)
                                <option value="{{$street->id}}">{{$street->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-9  card">
                @if(!$products->isEmpty())
                    <a href="{{route('run_errand_page')}}" class="btn helep_btn_raise">Send Custom Product Quote</a>
                    <div class="card helep-color" style="margin-top:15px;">
                        <div class="row card-body">
                            <div class="col-md-12">
                                <div class="m-2">
                                    <h4 class="index-2 pl-2 text-center text-white font-weight-bold  pb-2 mb-2 text-capitalize">
                                        {{$TotalProducts->count()}} Products found !<small></small></h4>
                                </div>
                                @php
                                    $column="col-md-3";
                                    $card_shadow ="";
                                     if($products->count() <=5) $column="col-md-3";
                                     $i=0;
                                @endphp
                                <div class="row card-deck">

                                    @foreach($products as $product)
                                        @php
                                            $length= 30;
                                                 if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                                                          $name= $match[0]."...";
                                                     } else{
                                                        $name= $product->name;
                                                 }
                                            $currency = $currencies->where('id',$product->currency_id)->first();
                                        @endphp

                                        <div class="{{$column}} card {{$card_shadow}} product-image-size">
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
                                                </a>
                                                <div class="card-title mt-1"><h5
                                                        class="text-black font-weight-bolder text-center">{{$name}}</h5>
                                                </div>
                                                <div class="card-text"><h6
                                                        class="font-weight-bold pb-1 text-muted helep-text-color text-center">{{$currency->name}} {{$product->unit_price}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                            if($i%3==0)
                                            {
                                        @endphp
                                </div>
                                <div class="row card-deck">
                                    @php
                                        }else{

                                        }
                                    @endphp
                                    @endforeach


                                </div>
                                {!! $products->appends(['search' => $keyword])->links() !!}
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
