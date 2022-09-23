{{--@extends('helep.general.master')--}}
@extends('helep.vendor.layout.master')

@section('css')
    <link rel="stylesheet" href="{{url('css/croppie.css')}}">
@endsection
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
                                    {{ csrf_field() }}
                                    <div class="w-100">

                                        <div id="product_images" class="row">

                                        </div>
                                        <div class="form-group">
                                            <input maxlength="100" type="text" class="form-control mb-2" name="Title" required
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
    <script src="{{url('js/croppie.js')}}"></script>
    <script src="{{url('js/moment.js')}}"></script>
    <script>
        var quoteImageCounter = 0;

        // function previewErrandPhoto(obj) {
        //     var img_id = obj.alt;
        //     var file = $("#" + obj.id).get(0).files[0];
        //     if (file) {
        //         var reader = new FileReader();
        //         reader.onload = function () {
        //             $('#' + img_id).removeClass('d-none');
        //             $("#" + img_id).attr("src", reader.result);
        //             quoteImageCounter++;
        //             $('#quoteImageCounter').val(quoteImageCounter);
        //         }
        //         $('#' + obj.id).addClass('helep_round');
        //         reader.readAsDataURL(file);
        //     }
        // }

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
    <script type="text/javascript">
        var i = 0;
        function preViewCrop(e,j) {
            var avatar = $('#preview-'+j);
            var input = $('#photo-'+j);
            var image = $('#ddimage-'+j);
            var $modal = $('#modal-'+j);
            var cropper;

            $('[data-toggle="tooltip"]').tooltip();
            var files = e.target.files;

            var done = function (url) {
                input.value = '';
                image.attr('src',url);
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;


            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                    r = new FileReader();
                    r.readAsDataURL(file);
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };

                    reader.readAsDataURL(file);
                }
            }

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image[0], {
                    aspectRatio: 2/1.5,
                    viewMode: 0,
                    enableZoom: true,
                    showZoomer: true,
                    ready: function () {
                        var clone = this.cloneNode();
                        clone.className = '';
                        clone.style.cssText = (
                            'display: block;' +
                            'width: 300px;'
                        );
                    },

                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            console.log("before croping")
            document.getElementById('crop-'+j).addEventListener('click', function () {
                var initialAvatarURL;
                var canvas;

                console.log("inside canvas croping")
                $modal.modal('hide');
                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width: 800,
                        height: 600,
                    });
                    avatar.attr('src', canvas.toDataURL());
                    canvas.toBlob(function (blob) {
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function () {
                            var base64data = reader.result;
                            button = '<div class="d-flex flex-nowrap  align-items-center">'+
                                '<label for="photo-' + i + '"  class="btn-success text-center py-2 flex-grow-1 font-10 radius-0">  Change</label>' +
                                '<label onclick="deleteContent(' + i + ')"  class="btn-danger text-center  py-2 font-10  flex-grow-1 radius-0"> Remove</label>'
                            '</div>';
                            $('#button-'+j).html(button)
                            $('#course_image-'+j).val(base64data)
                            if(j < i){
                            }else{
                                i = i + 1;
                                addImage()
                            }
                        }
                    });
                }
            });

        }

        addImage();

        function addImage(){
            html =
                '  <div id="image-' + i + '"  class="col-6 col-sm-6 col-md-4 col-lg-3 mb-2 preview-image">' +
                '     <div  class="d-flex border radius-15 position-relative w-100 flex-column h-100 select-photo">' +
                '         <div class="product-img">'+
                '             <input id="photo-'+ i +'" oninput="preViewCrop(event,' + i + ')"  type="file"' +
                '                    class="d-none files"' +
                '                    accept="image/*">' +
                '             <input type="hidden"  name="image[]" class="image-value" id="course_image-' + i + '"/>' +
                '             <img' +
                '                  class="img-fluid d-block" id="preview-' + i + '">' +
                '        </div>' +
                '        <div id="button-' + i + '" class="delete ">' +
                '           <div class="d-flex flex-column w-100 h-100 position-absolute align-items-center justify-content-center">'+
                '               <label for="photo-' + i + '"  class=" mb-0">  <i class="mdi mdi-plus mdi-18px"></i></label>'+
                '               <label class="font-10" for="photo-' + i + '">Add Image</label>'+
                '          </div>' +
                '        </div>' +
                '     </div>' +
                ' </div>'+



                '<div class="modal fade" id="modal-'+i+'" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">' +
                '    <div class="modal-dialog" role="document">' +
                '        <div class="modal-content">' +
                '            <div class="modal-header">' +
                '                <h5 class="modal-title" id="modalLabel">Crop the image</h5>' +
                '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '                    <span aria-hidden="true">&times;</span>' +
                '                </button>' +
                '            </div>' +
                '            <div class="modal-body">' +
                '                <div class="img-container">' +
                '    <img id="ddimage-'+i+'" style="max-height : 250px; width : auto; object-fit: contain;" src="">' +
                '                </div>' +
                '            </div>' +
                '            <div class="modal-footer">' +
                '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>' +
                '                <button type="button" class="btn btn-primary" id="crop-'+i+'">Crop</button>' +
                '            </div>' +
                '        </div>' +
                '    </div>' +
                '</div>'
            $('#product_images').append(html);
        }

        function deleteContent(j) {
            $('#image-' + j).remove();
        }
    </script>
    <script>
        $(function () {
            //set link indicator
            $("#run_errand_page").addClass('active');
        });

    </script>
@endsection
