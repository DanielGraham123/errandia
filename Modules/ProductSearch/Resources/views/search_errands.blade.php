@extends('helep.general.master')

@section('content')
    <div class="py-5 container">
        <div class="ml-n2 mr-n5">
            <div class="card helep_round">
                @if(session('message'))
                    <div class="alert alert-success">{!! session('message') !!}</div>
                @endif
                <div class="card-body row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="mb-2">
                            <h4 class="helep-text-color text-center font-weight-bold mb-2"
                                id="customSearchModalLabel">@lang("general.search_errand_form_title")</h4>
                            <div class="clearfix"><br/></div>
                            <div class="mt-2">
                                <div class="text-left">
                                    <h5 class="font-weight-bold">@lang('general.errands_custom_view_request_images')</h5>
                                    <div class="clearfix"><br/></div>
                                </div>
                                <form class="" method="POST" action="{{route('send_product_quote')}}"
                                      enctype="multipart/form-data">
                                    <div>
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-6 col-sm-3  mb-2">
                                                <div
                                                    class="d-flex border radius-15  w-100 select-photo">
                                                    <div class="rounded-lg"><img id="preview-errand-photo-1"
                                                                                 height="100%"
                                                                                 width="100%"
                                                                                 class="d-none" src=""></div>
                                                    <label for="errand-photo-1"
                                                           class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                                        <span class="text-center font-20">+</span> </label>
                                                    <input
                                                        alt="preview-errand-photo-1"
                                                        onchange="previewErrandPhoto(this)"
                                                        name="preview-1"
                                                        class="d-none" id="errand-photo-1" type="file">
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3  mb-2">
                                                <div
                                                    class="d-flex border radius-15  w-100 select-photo">
                                                    <div class="rounded-lg"><img id="preview-errand-photo-2"
                                                                                 height="100%"
                                                                                 width="100%"
                                                                                 class="d-none" src=""></div>
                                                    <label for="errand-photo-2"
                                                           class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                                        <span class="text-center font-20">+</span> </label>
                                                    <input
                                                        alt="preview-errand-photo-2"
                                                        onchange="previewErrandPhoto(this)"
                                                        name="preview-2"
                                                        class="d-none"
                                                        id="errand-photo-2" type="file">
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3  mb-2">
                                                <div
                                                    class="d-flex border radius-15  w-100 select-photo">
                                                    <div class="rounded-lg"><img class="d-none" height="100%"
                                                                                 width="100%"
                                                                                 id="preview-errand-photo-3" src="">
                                                    </div>
                                                    <label for="errand-photo-3"
                                                           class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                                        <span class="text-center font-20">+</span> </label>
                                                    <input
                                                        alt="preview-errand-photo-3"
                                                        onchange="previewErrandPhoto(this)"
                                                        name="preview-3"
                                                        class="d-none"
                                                        id="errand-photo-3" type="file">
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3  mb-2">
                                                <div
                                                    class="d-flex border radius-15  w-100 select-photo">
                                                    <div class="rounded-lg"><img class="d-none" height="100%"
                                                                                 width="100%"
                                                                                 id="preview-errand-photo-4" src="">
                                                    </div>
                                                    <label for="errand-photo-4"
                                                           class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                                        <span class="text-center font-20">+</span> </label>
                                                    <input
                                                        alt="preview-errand-photo-4"
                                                        onchange="previewErrandPhoto(this)"
                                                        name="preview-4"
                                                        rev="preview-errand-photo-4"
                                                        class="d-none"
                                                        id="errand-photo-4" type="file">
                                                </div>
                                            </div>

                                            <input id="counter" type="hidden" name="counter" value="0"/>
                                        </div>
                                        <div class="form-group">
                                            <input maxlength="100" type="text" class="form-control mb-2" name="Title" required
                                                   placeholder="Enter Matching Keywords for what you are looking for separated by comma eg: laptop, food, computers"/>
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <input type="text" class="form-control  mb-2" name="PhoneNumber"--}}
{{--                                                   required--}}
{{--                                                   placeholder="Phone Number"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <select class="form-control mb-2"--}}
{{--                                                    onchange="getSubCategoriesErrand(this)"--}}
{{--                                                    name="dialog_category"--}}
{{--                                                    id="dialogCategorySearch">--}}
{{--                                                <option value="none">Select Product Category</option>--}}
{{--                                                @foreach($categories as $category)--}}
{{--                                                    <option--}}
{{--                                                        value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <select class="form-control mb-2 subCategory" name="dialogCategory"
                                                    id="dialogCategory">
                                                <option value="">Select Product Category</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control region" name="region" id="regionSearch"
                                                    onchange="getTownsByRegionErrand(this)">
                                                <option value="">Filter By Region</option>
                                                @foreach($regions as $region)
                                                    <option
                                                        value="{{$region->id}}">{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control town" name="town" id="townSearch"
                                                    onchange="getCityByTownErrand(this)">
                                                <option value="">Filter By Town</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control street" name="street" id="streetSearch">
                                                <option value="">Filter By Street</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                           <textarea class="form-control html-editor" rows="5" name="Description" required
                                     placeholder="Description"></textarea>
                                        </div>
                                        <input type="submit" class="btn helep_btn_raise text-uppercase"
                                               value="Send Product Quote">
                                        <input id="quoteImageCounter" type="hidden" name="QuoteImageCounter"
                                               value="0"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var quoteImageCounter = 0;

        function previewErrandPhoto(obj) {
            var img_id = obj.alt;
            var file = $("#" + obj.id).get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#' + img_id).removeClass('d-none');
                    $("#" + img_id).attr("src", reader.result);
                    quoteImageCounter++;
                    $('#quoteImageCounter').val(quoteImageCounter);
                }
                $('#' + obj.id).addClass('helep_round');
                reader.readAsDataURL(file);
            }
        }

        function getSubCategoriesErrand(obj) {
            var category = $("#" + obj.id).val();
            if (!category) return;
            $("#sub_category").html("<option value=''>Please Wait ....</option>");
            $.ajax({
                datatype: "json",
                type: 'get',
                data: {
                    category: category
                },
                url: $("#baseUrl").val() + '/categories/subcategories/category',
                success: function (response) {
                    var res = JSON.parse(response);
                    $("#sub_category").html(res.data);
                    $(".subCategory").html(res.data);
                    $("#sub_category option:first").html("Select Shop Sub Category");
                    $(".subCategory option:first").html("Select Shop Sub Category");
                    $("#sub_category option:first").val("none");
                    $(".subCategory option:first").val("none");
                },
                error: function () {
                    console.log("Eror getting response");
                }
            });
        }

        function getCityByTownErrand(obj) {
            var townId = $("#" + obj.id).val();
            $.ajax({
                method: "get",
                url: $("#baseUrl").val() + '/street/town',
                data: {townId: townId},
                success: function (response) {
                    console.log("response: ", response);
                    $("#streetSearch").empty();
                    $("#streetSearch").append(response);
                    $("#streetSearch option:first").html("Filter By Street");
                    $("#streetSearch option:first").val("none");
                },
                error: function (error) {
                    $("#streetSearch").fadeOut(500);
                }
            });
        }

        function getTownsByRegionErrand(obj) {
            var region = $("#" + obj.id).val();
            if (region === "none") return;
            $("#town").html("<option value='none'>Loading Towns, Please Wait ....</option>");
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
                    $("#townSearch option:first").html("Filter By Town");
                    $("#townSearch option:first").val("none");
                },
                error: function () {
                    console.log("Eror getting response");
                }
            });
        }
    </script>
@endsection
