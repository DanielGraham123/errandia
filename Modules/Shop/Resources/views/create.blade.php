@extends('helep.admin.layout.master')
@section('page_title') @lang('shop.create_shop_page_title') @endsection
@section('title') @lang('shop.create_shop_page_title') @endsection
@section('content')
        <div class="p-4 shadow-sm bg-white">
            <div class=" d-flex justify-content-between">
                <div class="d-flex flex-wrap">
                    <a href="{{route('shop_list')}}">
                        <button type="button" class="btn helep_btn_raise">
                            <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                    </a>
                </div>
                <div class="d-flex flex-wrap"></div>
                <div class="d-flex flex-wrap"></div>
            </div>
            <div class="">
                <form method="POST" action="{{route('save_shop')}}"
                      class="my-2 d-flex-column align-items-center px-sm-5" enctype="multipart/form-data">
                    @csrf
                    <div class=" w-100">
                        <h5 class="text-black-50 font-weight-bold  mb-2 p-2">{{trans('shop.add_shop_personal_info_title_msg')}}</h5>
                        <div class="row">

                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <input value="{{ old('supplier_name') }}" name="supplier_name" type="text"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_full_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <input value="{{ old('email') }}" name="email" type="text" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_email')}}">
                                </div>
                            </div>
                            <div class="col-sm-4 "></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ old('tel') }}" name="tel" type="number" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_tel')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group is-focused">
                                    <input name="password" type="password" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_password')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_confirmed_pass')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <div class="form-group my-4 w-100">
                        <h5 class="text-black-50 font-weight-bold  mb-2 p-2">{{trans('shop.add_shop_business_info_title_msg')}}</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ old('shop_name') }}" name="shop_name" type="text"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_shop_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <label for="category_image">{{trans('shop.add_shop_placeholder_shop_image')}}</label>
                                <div class="form-group">
                                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                                    <input name="shop_image" id="shop_image" type="file" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_shop_image')}}">
                                    <img id="blah" src="{{asset('images/preview-image.jpg')}}" alt="your image"
                                         width="100"/>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="clearfix"><br/></div>
                        <div class="row d-none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="main-category" id="main-category" class="form-control"
                                            onchange="getSubCategoriesByCategory(this)">
                                        <option value="none">{{trans('shop.add_shop_placeholder_category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex flex-column ">
                                    <select class="form-control" name="category"
                                            id="sub_category">
                                        <option value="none">@lang('shop.add_shop_placeholder_sub_category')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"><br/></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-flex flex-column ">
                                    <select id="product-categories" class="form-control" name="categories[]"
                                            multiple="multiple" required>
                                        @foreach($subcategories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"><br/></div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="description">{{trans('shop.add_shop_placeholder_shop_description')}}</label>
                                <div class="form-group">
{{--                                    <textarea id="description" name="description"--}}
{{--                                              class="form-control html-editor"></textarea>--}}
                                    @include('helep.general.components.richtext_editor',['textareaName'=>'description'])

                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <div class="form-group w-100">
                        <h5 class="text-black-50 font-weight-bold  mb-2 p-2">{{trans('shop.add_shop_contact_info_title_msg')}}</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ old('whatsapp') }}" name="whatsapp" type="text" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_whatsapp')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ old('address') }}" name="address" type="text" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_address')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ old('website') }}" name="website" type="url" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_website')}}" required>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select id="region" name="region" class="form-control"
                                            onchange="getTownsByRegion(this)">
                                        <option value="">{{trans('shop.add_shop_placeholder_region')}}</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="town" class="form-control" id="town" onchange="getCityByTown(this)">
                                        <option value="none">{{trans('shop.add_shop_placeholder_town')}}</option>
                                        {{--                                        @foreach($towns as $town)--}}
                                        {{--                                            <option value="{{$town->id}}">{{$town->name}}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="street" class="form-control" id="street">
                                        <option value="none">{{trans('shop.add_shop_placeholder_street')}}</option>
                                        {{--                                        @foreach($streets as $street)--}}
                                        {{--                                            <option value="{{$street->id}}">{{$street->name}}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <div class="align-self-start d-flex-column mt-4 mb-2">
                        <button
                            class="btn  helep_btn_raise px-5 shadow w-100">{{trans('shop.add_shop_button_save')}}</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
@section('js')
    <script>
        console.log("could it be the script")
        $(function () {
            //set link indicator
            $("#admin_manage_shops").addClass('active');
            console.log("What is happening")
            $('#product-categories').select2({
                closeOnSelect: false,
                placeholder: "Select Shop Category"
            });
        });
        shop_image.onchange = evt => {
            const [file] = shop_image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script src="{!!asset("js/user-utilities.js")!!}"></script>
@endsection
