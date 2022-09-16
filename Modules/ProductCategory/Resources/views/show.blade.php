@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.sub_category_list_msg',['category'=>$category->name]) @endsection
@section('title') @lang('admin.sub_category_list_msg',['category'=>$category->name]) @endsection
@section('content')
    <div class="p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap">
                <a href="{{route('categories')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_sub_category',['id'=>$category->slug])}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_sub_category_new')}}</button>
                </a></div>
        </div>
        <div class="row my-5">
            @foreach($categories as $sub_category)
                <div class="col-md-4 helep_round img-thumbnail col-lg-4 mb-5">
                    <a href="{{route('edit_sub_category',['id'=>$category->slug,'category'=>$sub_category->slug])}}"
                       class="d-flex-column align-items-center">
                        <div class="">
                            <img class="rounded-lg" style="max-height: 150px; max-width: 200px "
                                 src="{{asset('storage/'.$sub_category->image_path)}}">
                        </div>
                        <span class="mt-3 text-black-50">{{$sub_category->name}}</span>
                        <div class="clearfix">
                            <hr/>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="d-flex flex-wrap ml-lg-5">
                                <a href="{{route('edit_sub_category',['id'=>$category->slug,'category'=>$sub_category->slug])}}"
                                   class="text-muted"><i
                                            class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="{{route('delete_sub_category',['id'=>$category->slug,'category'=>$sub_category->slug])}}"
                                   class="text-muted pl-4"><i
                                            class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @if($categories->isEmpty())
            <div class=" alert alert-info helep_alert_round text-center font-weight-bold">
                @lang('admin.no_sub_category_list')
            </div>
        @endif
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
