@extends('helep.admin.layout.master')
@section('page_title') @lang('shop.update_shop_page_title') @endsection
@section('title') @lang('shop.update_shop_page_title') @endsection
@section('content')
    <div class="">
        <div class="p-2 shadow-sm">
            <div class=" d-flex justify-content-between">
                <div class="d-flex flex-wrap"><a href="{{route('shop_list')}}">
                        <button type="button" class="btn  helep_btn_raise">
                            <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                    </a></div>
                <div class="clearfix"><br/><br/></div>
            </div>
            <div class="">
                <form method="POST" action="{{route('update_shop',['id'=>$shop->slug])}}"
                      class="my-2 d-flex-column align-items-center px-sm-5" enctype="multipart/form-data">
                    @csrf
                    <div class=" w-100">
                        <h5 class="text-black-50 font-weight-bold  mb-2 p-2">{{trans('shop.add_shop_personal_info_title_msg')}}</h5>
                        <div class="row">

                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <input value="{{ $shop->user->name }}" name="supplier_name" type="text"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_full_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <input readonly value="{{ $shop->user->email }}" name="email" type="text"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_email')}}">
                                </div>
                            </div>
                            <div class="col-sm-4 "></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ $shop->shopContactInfo->tel }}" name="tel" type="number"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_tel')}}">
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
                                    <input value="{{ $shop->name }}" name="shop_name" type="text"
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
                                    <input name="shop_image" type="file"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_shop_image')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <img class="img-thumbnail" src="{{asset('storage/'.$shop->image_path)}}"
                                         style="max-height: 150px; max-width: 200px "/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"><br/></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select onchange="getSubCategoriesByCategory(this)" id="main-category"
                                            name="main-category" class="form-control">
                                        <option value="none">{{trans('shop.add_shop_placeholder_category')}}</option>
                                        @foreach($categories as $category)
                                            @if($category->id == $shop->category->category->id)
                                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <select class="form-control" name="category"
                                            id="sub_category">
                                        <option value="none">@lang('shop.add_shop_placeholder_sub_category')</option>
                                        <option selected
                                                value="{{$shop->category->id}}">{{$shop->category->name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"><br/></div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="description">{{trans('shop.add_shop_placeholder_shop_description')}}</label>
                                <div class="form-group">
                            <textarea id="description" name="description" class="form-control">
                                {{$shop->description}}
                            </textarea>
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
                                    <input value="{{ $shop->shopContactInfo->whatsapp_number}}" name="whatsapp" type="text" class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_whatsapp')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ $shop->shopContactInfo->address }}" name="address" type="text"
                                           class="form-control"
                                           placeholder="{{trans('shop.add_shop_placeholder_address')}}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input value="{{ $shop->shopContactInfo->website_link }}" name="website" type="url"
                                           class="form-control"
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
                                            @if($region->id == $shop->shopContactInfo->street->town->region_id)
                                                <option selected value="{{$region->id}}">{{$region->name}}</option>
                                            @else
                                                <option value="{{$region->id}}">{{$region->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select id="town" name="town" class="form-control" onchange="getCityByTown(this)">
                                        <option value="none">{{trans('shop.add_shop_placeholder_town')}}</option>
                                        <option selected
                                                value="{{$shop->shopContactInfo->street->town->id}}">{{$shop->shopContactInfo->street->town->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select id="street" name="street" class="form-control">
                                        <option value="none">{{trans('shop.add_shop_placeholder_street')}}</option>
                                        <option selected
                                                value="{{$shop->shopContactInfo->street_id}}">{{$shop->shopContactInfo->street->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <div class="align-self-start d-flex-column mt-4 mb-2">
                        <button
                            class="btn  helep_btn_raise px-5 shadow w-100">{{trans('shop.update_shop_button_save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_shops").addClass('active');
        });
    </script>
    <script src="{!!asset("js/user-utilities.js")!!}"></script>
@endsection
