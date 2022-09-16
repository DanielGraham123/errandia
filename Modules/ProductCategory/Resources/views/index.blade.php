@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.category_list_msg') @endsection
@section('title') @lang('admin.category_list_msg') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_category')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_category_new')}}</button>
                </a></div>
        </div>
        @foreach($categories->chunk(4) as $chunk)
            <div class="row card-deck my-5">
                @foreach($chunk as $category)
                    <div class="col-md-4 card helep_round col-lg-4 mb-5">
                        <a href="{{route('show_category',['id'=>$category->slug])}}">
                            <img style="max-height: 150px; max-width: 200px " class="ml-lg-3 rounded pt-1 card-img-top"
                                 src="{{asset('storage/'.$category->image_path)}}" alt="Category Image">
                            <div class="card-body">
                                <h5 class="card-title text-black-50 font-weight-bold">{{$category->name}}</h5>
                                <p class="card-text text-black-50">{{$category->description}}</p>
                                <p class="card-text">
                                    <a href="{{route('edit_category',['id'=>$category->slug])}}"
                                       class="text-muted"><i
                                            class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                                    <a href="{{route('delete_category',['id'=>$category->slug])}}"
                                       class="text-muted pl-4"><i
                                            class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                                </p>
                            </div>
                        </a>
                        {{--<a href="{{route('edit_category',['id'=>$category->slug])}}"--}}
                        {{--class="d-flex-column align-items-center">--}}
                        {{--<div class="shop-avatar">--}}
                        {{--<img class="" src="{{asset('storage/'.$category->image_path)}}">--}}
                        {{--</div>--}}
                        {{--<span class="mt-3 text-black-50">{{$category->name}}</span>--}}
                        {{--</a>--}}
                    </div>
                @endforeach
            </div>
        @endforeach

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
