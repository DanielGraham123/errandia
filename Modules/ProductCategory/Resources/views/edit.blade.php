@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.category_update_title_msg') @endsection
@section('title') @lang('admin.category_update_title_msg') @endsection
@section('content')
    <div class="">
        <div class="p-2 shadow-sm">
            <div class=" d-flex justify-content-between">
                <div class="d-flex flex-wrap"><a href="{{route('categories')}}">
                        <button type="button" class="btn helep_btn_raise">
                            <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                    </a></div>
                <div class="d-flex flex-wrap"></div>
                <div class="d-flex flex-wrap"></div>
            </div>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST"
                  action="{{route('update_category',['id'=>$category->slug])}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">{{trans('admin.category_info')}}</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input value="{{$category->name}}" name="name" type="text" class="form-control"
                                       placeholder="{{trans('admin.category_name')}}">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 ">
                            <label for="description">{{trans('admin.description')}}</label>
                            <div class="input-group border-with-radius mb-3">
                                <textarea id="description" name="description" class="form-control">
                                    {{$category->description}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-sm-4 "></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div>
                                <img class="img-thumbnail" src="{{asset('storage/'.$category->image_path)}}"
                                     style="max-height: 150px; max-width: 200px "/>
                            </div>
                            <input type="hidden" name="image_path" value="{{$category->image_path}}"/>
                            <label for="category_image">{{trans('admin.category_image')}}</label>
                            <div class="input-group border-with-radius mb-3">
                                <input id="category_image" name="category_image" type="file" class="form-control"
                                       placeholder="{{trans('admin.category_image')}}">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="align-self-start d-flex-column mt-4 mb-2">
                    <button class="btn helep_btn_raise px-5 w-100">{{trans('admin.update_category_btn')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_category").addClass('active');
        });
    </script>
@endsection
