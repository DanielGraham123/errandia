{{--@extends('helep.general.master')--}}
@extends('helep.vendor.layout.master')

@section('css')
    <link rel="stylesheet" href="{{url('css/croppie.css')}}">
@endsection
@section('content')
{{--    <div class="py-5 container">--}}

            <div>
                @if(session('message'))
                    <div class="alert alert-success">{!! session('message') !!}</div>
                @endif
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="mb-2">
                            <h4 class="helep-text-color font-weight-bold mb-2"
                                id="customSearchModalLabel">@lang("general.search_errand_form_title")</h4>
                            <div class="clearfix"><br/></div>
                            <div class="mt-2">
                                <div class="text-left">
                                    <h5 class="font-weight-bold">@lang('general.errands_custom_view_request_images')</h5>
                                    <div class="clearfix"><br/></div>
                                </div>
                                <form class="" method="POST" action="{{route('send_product_quote')}}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="w-100">

                                        <div id="product_images" class="row">

                                        </div>
                                        <div class="form-group">
                                            <input maxlength="100" type="text" class="form-control mb-2" name="Title"
                                                   required
                                                   placeholder="Enter Matching Keywords for what you are looking for separated by comma eg: laptop, food, computers"/>
                                        </div>
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
                                        <input id="quoteImages" type="hidden" name="QuoteImages"
                                               value="0"/>
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

{{--    </div>--}}
@endsection
@section('js')
    <script src="{{url('js/croppie.js')}}"></script>
    <script src="{{url('js/moment.js')}}"></script>
    <script>
        let quoteImageCounter = 0;


        function getSubCategoriesErrand(obj) {
            let category = $("#" + obj.id).val();
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
                    let res = JSON.parse(response);
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
            let townId = $("#" + obj.id).val();
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
            let region = $("#" + obj.id).val();
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
                    let res = JSON.parse(response);
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
    <script type="text/javascript">
        let i = 0;
        addImage();

        function addImage() {
            const quoteImageCounter = $('#quoteImageCounter').val();

            html =
                '  <div id="image-' + i + '"  class="col-6 col-sm-6 col-md-4 col-lg-3 mb-2 preview-image">' +
                '     <div  class="d-flex border radius-15 position-relative w-100 flex-column h-100">' +
                '         <div class="product-img select-photo">' +
                '             <input id="photo-' + i + '" oninput="processFiles(event,' + i + ')"  type="file"' +
                '                    class="d-none files"' +
                '                    accept="image/*" name="image[]">' +
                '             <img' +
                '                  class="w-100 img-fluid d-block h-100" id="preview-' + i + '">' +
                '        </div>' +
                '        <div id="button-' + i + '" class="delete ">' +
                '           <div class="d-flex flex-column w-100 h-100 position-absolute align-items-center justify-content-center" style="bottom: 0">' +
                '               <label for="photo-' + i + '"  class="align-items-center justify-content-center d-flex flex-column h-100 w-100 cursor-pointer" >  <i class="mdi mdi-plus mdi-18px"></i> <span>Add Image</span></label>' +
                '          </div>' +
                '        </div>' +
                '     </div>' +
                ' </div>' ;

            $('#product_images').append(html);

        }

        function deleteContent(j) {
            $('#image-' + j).remove();
            let quoteImageCounter = $('#quoteImageCounter').val();
            quoteImageCounter = parseInt(quoteImageCounter) - 1;
            $('#quoteImageCounter').val(quoteImageCounter);
            if (quoteImageCounter === 3) {
                i = i + 1;
                addImage();
            }

        }

        function processFiles(e, j) {
            let avatar = $('#preview-' + j);
            let input = $('#photo-' + j);
            if (e.target.files.length) {
                try {
                    // eslint-disable-next-line no-unused-vars

                    const file = e.target.files[0];
                    file.url = URL.createObjectURL(file);
                    let button = '<div class="d-flex flex-nowrap  align-items-center">' +
                        '<label for="photo-' + i + '"  class="btn-success text-center py-2 flex-grow-1 font-10 mb-0 radius-0">  Change</label>' +
                        '<label onclick="deleteContent(' + i + ')"  class="btn-danger text-center  py-2 font-10 mb-0 flex-grow-1 radius-0"> Remove</label>'
                    '</div>';
                    $('#button-' + j).html('');
                    avatar.attr('src', file.url);
                    $('#button-' + j).html(button).addClass('img-preview-buttons');
                } catch (error_message) {
                    console.log(error_message);
                }
                input.value = '';
                let quoteImageCounter = $('#quoteImageCounter').val() || 0;
                quoteImageCounter = parseInt(quoteImageCounter) + 1;
                $('#quoteImageCounter').val(quoteImageCounter);
                if (quoteImageCounter < 4) {
                    i = i + 1;
                    addImage()
                }
            }
        }
    </script>
    <script>
        $(function () {
            //set link indicator
            $("#run_errand_page").addClass('active');
        });

    </script>
@endsection
