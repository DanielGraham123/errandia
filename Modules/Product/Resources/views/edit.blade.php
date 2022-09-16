@extends('helep.vendor.layout.master')
@section('page_title') @lang('vendor.update_product_page_title') @endsection
@section('title') @lang('vendor.update_product_page_title') @endsection
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
        <form enctype="multipart/form-data" method="POST" action="{{route('update_product',['id'=>$product->slug])}}"
              class="my-4 d-flex-column align-items-center px-sm-5">
            @csrf
            <div class="w-100">
                <div>
                    <div class="form-group mb-3">
                        <input value="{{$product->name}}" name="name" type="text" class="form-control"
                               placeholder="{{trans('vendor.add_product_name_label')}}">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <select id="category" class="form-control" onchange="getSubCategoriesByCategory(this)"
                            name="category">
                        <option value="none">@lang('vendor.add_product_category_label')</option>
                        @foreach($categories as $category)
                            @if($category->id ==$product->subCategory->category_id)
                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif

                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <select class="form-control" name="sub_category"
                            id="sub_category">
                        <option selected value="{{$product->subCategory->id}}">{{$product->subCategory->name}}</option>
                        <option value="none">@lang('vendor.add_product_sub_category_label')</option>
                    </select>
                </div>
                <div class="form-group  mb-3">
                    <input value="{{$product->unit_price}}" type="number" name="price" class="form-control"
                           placeholder="{{trans('vendor.add_product_unit_price_label')}}">
                </div>
                <div class="form-group">
                    <select name="currency" class="form-control">
                        <option value="none">@lang('vendor.add_product_currency_label')</option>
                        @foreach($currencies as $currency)
                            @if($currency->id == $product->currency_id)
                                <option selected value="{{$currency->id}}">{{$currency->name}}</option>
                            @else
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <input name="quantity" value="{{$product->quantity}}" type="number" class="form-control"
                           placeholder="@lang('vendor.add_product_quantity_label')"/>
                </div>
             
                <div class="form-group mb-3">
                                <textarea style="height: 300px;font-size: 20px" name="description" cols="10"
                                          class="html-editor form-control"
                                          placeholder="{{trans('vendor.add_product_description_label')}}">
                                    {!! $product->description !!}
                                </textarea>
                </div>

                <h6 class="text-black px-4 my-3">@lang('vendor.add_product_image_title')</h6>
                <div class="row">
                    <div class="col-6 col-sm-3  mb-2">
                        <div for="photo-1" class="d-flex border radius-15  w-100 select-photo">
                            <div class="rounded-lg"><img id="preview-1" height="100%" width="100%"
                                                         src="{{asset('storage/'.$product->featured_image_path)}}">
                            </div>
                            <label for="photo-1"
                                   class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                <span class="text-center font-20">+</span>
                                <span class="text-center font-10">@lang('vendor.add_product_feature_image_title')</span>
                            </label>
                            <input onchange="previewProduct(this,'preview-1')" name="product-1" class="d-none"
                                   id="photo-1" type="file">
                        </div>
                    </div>
                    @php
                        $counter =2;
                    @endphp
                    @foreach($product->images->sortDesc() as $image)
                        <div class="col-6 col-sm-3  mb-2">
                            <div for="photo-{{$counter}}" class="d-flex border radius-15  w-100 select-photo">
                                <div class="rounded-lg">
                                    <img id="preview-{{$counter}}" height="100%" width="100%"
                                         src="{{asset('storage/'.$image->image_path)}}">
                                </div>
                                <label for="photo-{{$counter}}"
                                       class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                    <span class="text-center font-20">+</span>
                                </label>
                                <input onchange="previewProduct(this,'preview-{{$counter}}')" name="product-{{$counter}}"
                                       class="d-none"
                                       id="photo-{{$counter}}" type="file">
                            </div>
                        </div>
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                    <input id="counter" type="hidden" name="counter" value="0"/>
                </div>
            </div>
            <div class="align-self-end d-flex-column">
                <button class="btn helep_btn_raise mb-5 px-5  w-100">@lang('vendor.update_product_btn_label')</button>
            </div>
        </form>
    </div>
@endsection
@section('css')
    <link href="{{asset('summernote/dist/summernote.css')}}" rel="stylesheet">
@stop
@section('js')
    <script src="{!!asset("summernote/dist/summernote-updated.min.js")!!}"></script>
    <script>
        $(function () {
            //set link indicator
            $("#vendor_manage_product").addClass('active');
            // previewProduct('','');
            loadHtmlEditor();
        });
        var counter = 0;

        function previewProduct(obj, img_id) {
            var file = $("#" + obj.id).get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#' + img_id).removeClass('d-none');
                    $("#" + img_id).attr("src", reader.result);
                    counter++;
                    $('#counter').val(counter);
                }
                $('#' + obj.id).addClass('helep_round');
                reader.readAsDataURL(file);
            }
        }

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

        function loadHtmlEditor() {
            if ($('.html-editor')[0]) {
                $('.html-editor').summernote({
                    height: 300
                });
            }
            if ($('.html-editor-click')[0]) {
                //Edit
                $('body').on('click', '.hec-button', function () {
                    $('.html-editor-click').summernote({
                        focus: true
                    });
                    $('.hec-save').show();
                })
                //Save
                $('body').on('click', '.hec-save', function () {
                    $('.html-editor-click').code();
                    $('.html-editor-click').destroy();
                    $('.hec-save').hide();
                    notify('Content Saved Successfully!', 'success');
                });
            }
            //Air Mode
            if ($('.html-editor-airmod')[0]) {
                $('.html-editor-airmod').summernote({
                    airMode: true
                });
            }

        }
    </script>
@endsection
