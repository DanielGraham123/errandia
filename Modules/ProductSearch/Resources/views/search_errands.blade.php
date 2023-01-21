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

                        <form class="" method="POST" action="{{route('send_product_quote')}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="w-100">
                                <div id="step-1" data-step="1">
                                    <div class="form-group">
                                        <input id="product-title" maxlength="30" type="text" class="form-control mb-0" name="Title"
                                               required
                                               value="{{ @old('Title') }}"
                                               placeholder="Enter product name eg: laptop"/>
                                        <span class="d-flex align-items-center justify-content-end">
                                            <span id="entered-characters">0</span>
                                            <span>/30</span>
                                        </span>
                                        <p id="title-required" class="d-none text-danger bold">Enter a Matching Keyword</p>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control region" name="region" id="regionSearch"
                                                onchange="getTownsByRegionErrand(this)">
                                            <option value="">Filter By Region</option>
                                            @foreach($allRegions as $region)
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
                                    <div class="text-left">
                                        <h5 class="font-weight-bold">@lang('general.errands_custom_view_request_images')</h5>
                                        <div class="clearfix"><br/></div>
                                        <div id="product_images" class="row"></div>

                                    </div>
                                </div>
                                <div id="step-2" data-step="2" class="d-none">
                                    <div class="form-group">
                                        <select id="product-categories" class="form-control region" name="categories[]"
                                                multiple="multiple" required>
                                        </select>
                                        <small class="italic">Select categories for better results</small>
                                    </div>

                                </div>
                                <div class="mt-4">
                                    <input id="next-btn" type="button" class="btn helep_btn_raise text-uppercase"
                                           value="Next">
                                    <input id="submit-btn" type="submit"
                                           class="btn helep_btn_raise text-uppercase d-none"
                                           value="Send Product Quote">
                                    <input id="quoteImages" type="hidden" name="QuoteImages"
                                           value="0"/>
                                    <input id="quoteImageCounter" type="hidden" name="QuoteImageCounter"
                                           value="0"/>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

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
                    $("#sub_category option:first").val("");
                    $(".subCategory option:first").val("");
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
                    $("#streetSearch option:first").val("");
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
                    $("#townSearch option:first").val("");
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
                '  <div id="image-' + i + '"  class="col-md-3 mb-2 preview-image">' +
                '     <div  class="d-flex border radius-15 position-relative w-100 flex-column h-100 select-photo">' +
                '         <div class="product-img">' +
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
                ' </div>';

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
                    avatar.attr('src', file.url).removeClass('img-fluid');
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
            $('#product-categories').select2({
                closeOnSelect: false,
                placeholder: "Select Product Category"
            });
            $(document).on('keyup','#product-title',function (){
                let fieldValue = $(this).val();
                let trimmedValue = fieldValue ? fieldValue.toString().replace(/^\s+|\s+$/gm, '').replace(/(\r\n|\n|\r)/gm, "") : undefined ;
                let charLen = 0;
                if(trimmedValue){
                    charLen =trimmedValue.length;
                }
                $("#entered-characters").html(charLen);

            });
            $(document).on('click', '#next-btn', function (e) {
                e.preventDefault();
                let title = $("input[name='Title']").val() ? $("input[name='Title']").val() : ""
                if (!title) {
                    $("#title-required").removeClass('d-none');
                } else {
                    $("#title-required").addClass('d-none');
                    $(this).attr("disabled", 'disabled')//.val("Loading categories...");
                    let region = $("select[name='region']").val();
                    let street = $("select[name='street']").val()
                    let town = $("select[name='town']").val();
                    if (!street || street == 'none') {
                        street = "";
                    }
                    if (!town || town == 'none') {
                        town = "";
                    }
                    if (!region || region == 'none') {
                        region = "";
                    }
                    const data = {
                        region,
                        street,
                        town,
                        description: $("textarea[name='Description']").val() ? $("textarea[name='Description']").val() : "",
                        title: $("input[name='Title']").val() ? $("input[name='Title']").val() : ""
                    };
                    const that = $(this);
                    $.ajax({
                        datatype: "json",
                        type: 'get',
                        data: data,
                        url: $("#baseUrl").val() + '/productsearch/product-categories',
                        success: function (response) {
                            $("#product-categories").empty();
                            $("#product-categories").html(response);
                            $("#step-2").removeClass('d-none');
                            that.fadeOut('slow').addClass('d-none');
                            $("#submit-btn").removeClass('d-none').fadeIn('normal')
                        },
                        error: function () {
                            console.log("Eror getting response");
                        }
                    });

                }
            });
        });

    </script>
@endsection
