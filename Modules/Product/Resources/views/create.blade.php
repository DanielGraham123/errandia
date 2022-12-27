@extends('helep.vendor.layout.master')
@section('page_title') @lang('vendor.add_product_page_title') @endsection
@section('title') @lang('vendor.add_product_page_title') @endsection
@section('style')
    <link rel="stylesheet" href="{{url('css/croppie.css')}}">
@endsection
@section('content')
    <div class="container py-5">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"><a href="{{route('products')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <div class="clearfix"><br/></div>
        <form id="add_product_form" enctype="multipart/form-data" method="POST" action="{{route('save_product')}}"
              class="my-4 d-flex-column align-items-center px-sm-5">
            @csrf
            <div class="w-100">
                <div>
                    <div class="form-group mb-3">
                        <input value="{{old('name')}}" name="name" type="text" class="form-control"
                               placeholder="{{trans('vendor.add_product_name_label')}}">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <select id="sub_category" class="form-control"
                            name="sub_category" >
                        <option value="none">@lang('vendor.add_product_category_label')</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                {{ old('sub_category') === $category->id ? 'selected' : '' }}
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

{{--                <div class="form-group mb-3">--}}
{{--                    <select class="form-control" name="sub_category"--}}
{{--                            id="sub_category">--}}
{{--                        <option value="none">@lang('vendor.add_product_sub_category_label')</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="form-group  mb-3">
                    <input value="{{old('price')}}" type="number" name="price" class="form-control"
                           placeholder="{{trans('vendor.add_product_unit_price_label')}}">
                </div>
                <div class="form-group">
                    <select name="currency" class="form-control">
                        <option value="none">@lang('vendor.add_product_currency_label')</option>
                        @foreach($currencies as $key=>$currency)
                            <option value="{{$currency->id}}" @if($key == 0) selected @endif>{{$currency->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <input name="quantity" value="{{old('quantity',1)}}" type="number" class="form-control"
                           placeholder="@lang('vendor.add_product_quantity_label')"/>
                </div>
                <div class="form-group mb-3">
                                <label>{{trans('vendor.add_product_description_label')}}</label>
                    <br/>

                    @include('helep.general.components.richtext_editor',['textareaName'=>'description'])

                </div>

                <h6 class="text-black px-4 my-3">@lang('vendor.add_product_image_title')</h6>

                <div id="product_images" class="row">

                </div>
            </div>
            <div class="clearfix"><br/></div>
            <div class="align-self-center d-flex-column">
                <button id="create_product_btn" class="btn helep_btn_raise mb-5 px-5  w-100">@lang('vendor.add_product_btn_label')</button>
            </div>
        </form>
    </div>
@endsection

@section('js')

    <script>
        $(function () {
            // previewProduct('','');
            //set link indicator
            $("#vendor_manage_product").addClass('active');
            $(document).on('click','#create_product_btn',function (e){
                $(this).attr('disabled',true);
                $("#add_product_form").submit();
            })
        });

        function getSubCategoriesByCategory(obj) {
            var category = $("#" + obj.id).val();
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
                    $("#sub_category").html(res.data);
                },
                error: function () {
                    console.log("Eror getting response");
                }
            });
        }

    </script>

    <script src="{{url('js/croppie.js')}}"></script>
    <script src="{{url('js/moment.js')}}"></script>
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

            document.getElementById('crop-'+j).addEventListener('click', function () {
                var initialAvatarURL;
                var canvas;

                $modal.modal('hide');
                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width: 800,
                        height: 600,
                    });
                    avatar.attr('src', canvas.toDataURL()).removeClass('img-fluid');
                    canvas.toBlob(function (blob) {
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function () {
                            var base64data = reader.result;
                            button = '<div class="d-flex flex-nowrap align-items-center position-absolute w-100" style="bottom: 0">'+
                                '<label for="photo-' + i + '"  class="btn-success text-center py-2 flex-grow-1 font-10 radius-0 mb-0">  Change</label>' +
                                '<label onclick="deleteContent(' + i + ')"  class="btn-danger text-center  py-2 font-10  flex-grow-1 radius-0 mb-0"> Remove</label>'
                            '</div>';
                            $('#button-'+j).html(button).addClass('img-preview-buttons')
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
                '     <div  class="d-flex border radius-15 position-relative w-100 flex-column select-photo">' +
                '         <div class="product-img">'+
                '             <input id="photo-'+ i +'" onchange="preViewCrop(event,' + i + ')"  type="file"' +
                '                    class="d-none files"' +
                '                    accept="image/*">' +
                '             <input type="hidden"  name="image[]" class="image-value" id="course_image-' + i + '"/>' +
                '             <img' +
                '                  class="img-fluid d-block h-100 w-100" id="preview-' + i + '">' +
                '        </div>' +
                '        <div id="button-' + i + '" class="delete">' +
                '           <div class="d-flex flex-column w-100 h-100 position-absolute align-items-center justify-content-center" style="bottom: 0">'+
                '               <label for="photo-' + i + '"  class="align-items-center justify-content-center d-flex flex-column h-100 w-100 cursor-pointer" >  <i class="mdi mdi-plus mdi-18px"></i> <span>Add Image</span></label>' +
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

@endsection
