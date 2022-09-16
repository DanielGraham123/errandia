@extends('slider::layouts.master')

@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.sidebar_manage_slider') @endsection
@section('title') @lang('admin.sidebar_manage_slider') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_slider')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_slider_new')}}</button>
                </a></div>
        </div>
        
            <div class="row card-deck my-5">
                <table class="table table-striped">
                	<tr>
                    	<th>Image</th>
                        <th>Caption</th>
                    	<th>Sub Category</th>
                        <th>Duration (Days)</th>
                        
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                @foreach($sliders as $slider)
                    <tr>
                    	<td><img  height="80" width="95" src="{{asset('storage/'.$slider->image)}}" /></td>
                        <td>{{$slider->caption}}</td>
                    	<td>{{$slider->name}}</td>
                        <td>{{$slider->duration}}</td>
                       
                        <td>
                        @if($slider->status==0)
                        	<span style="color:#CC6600; font-weight:bold;">Inactive!</span>
                        @else
                        	<span style="color:#00CC00;font-weight:bold;">Active</span>
                        @endif
                        </td>
                        <td><a href="{{route('edit_slider',['id'=>$slider->id])}}" class="text-muted"><i
                                            class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                                    <a href="{{route('delete_slider',['id'=>$slider->id])}}" onclick="return confirm('Delete Now ?');"
                                       class="text-muted pl-4"><i
                                            class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                        
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        

    </div>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#sidebar_manage_slider").addClass('active');
        });
    </script>
@endsection


