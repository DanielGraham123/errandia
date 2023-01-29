@extends('helep.general.master')

@section('content')
    @php

    @endphp
    <div class="py-5 container-lg">
        <div class="ml-lg-n2 mr-lg-n5">
            <div class="row  card-body helep_alert_round">

                <div class="col-md-3">

                    <form name="Sort" action="{{route('regions_stores',['id' => $region->id])}}" method="get">

                        <select class="form-control" name="town" id="townSearch" onchange="this.form.submit();">
                            <option value="">Select Town</option>
                            @foreach($towns as $town)
                                <option
                                    value="{{$town->id}}" <?php echo request('town') == $town->id ? 'selected="selected"' : '';?>> {{$town->name}} </option>
                            @endforeach
                        </select>

                        <select class="form-control" name="street" id="streetSearch" onchange="this.form.submit();">
                            <option value="">Select Street</option>
                            @foreach($streets as $street)
                                <option
                                    value="{{$street->id}}" <?php echo $street->id == request('street') ? 'selected="selected"' : '';?>>{{$street->name}}</option>
                            @endforeach
                        </select>

                        <select class="form-control" name="category" onchange="this.form.submit();">
                            <option value=""> All Category</option>

                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}" <?php echo request('category') == $category->id ? 'selected="selected"' : '';?>> {{$category->name}} </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class=" col-md-9 bg-helep-blue">

                    <div class="p-2 m-2">
                        <h4 class="text-white font-weight-bold pb-2 mb-2 text-center">
                            @lang('general.components_popular_search_shops_title',['region'=>$region->name])
                        </h4>
                    </div>
                    <div class="row">
                        @if(count($stores)>0)
                            @foreach ($stores as $store)
                                <div class="col-md-2 p-1 text-center">
                                    <a href="{{route('show_shop_page',['id'=>$store->slug])}}"
                                       class="d-flex-column align-items-center">
                                        <div class="shop-avatar"
                                             style="height: 100px !important;width: 100px !important; background-color: #FAFAFA
 !important">
                                            <img src="{{asset('storage/'.$store->image_path)}}">
                                        </div>
                                        <span class="mt-1 text-center text-white font-weight-bold"
                                              style="text-overflow: ellipsis; font-size: 13px">{{$store->name}}</span>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 p-1 text-center">
                                There are no store in this region !
                            </div>
                        @endif
                    </div>
                    {{ $stores->appends(['town'=>request('town'),'category'=>request('region'),'street'=>request('street')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function getTowns() {
            var region = $("#regionSearch").val();
            if (region === "none") return;
            $("#townSearch").html("<option value='none'>Please Wait ....</option>");
            $.ajax({
                datatype: "json",
                type: 'get',
                data: {
                    region: region
                },
                url: $("#baseUrl").val() + '/region/town',
                success: function (response) {
                    var res = JSON.parse(response);
                    $("#townSearch").html(res.data);
                    setTimeout(getStreets, 500);
                },
                error: function () {
                    console.log("Eror getting response");
                }
            });
        }
        function getStreets() {

            var town = $("#townSearch").val();
            if (town === "none") return;
            $("#streetSearch").html("<option value='none'>Please Wait ....</option>");
            $.ajax({
                datatype: "json",
                type: 'get',
                data: {
                    town: town
                },
                url: $("#baseUrl").val() + '/town/street',
                success: function (response) {
                    var res = JSON.parse(response);
                    $("#streetSearch").html(res.data);
                },
                error: function () {
                    console.log("Eror getting response");
                }
            });
        }
    </script>
@endsection
