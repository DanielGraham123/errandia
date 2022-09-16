@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.street_update_title_msg') @endsection
@section('title') @lang('admin.street_update_title_msg') @endsection
@section('content')
    <div class="">
        <div class="p-2 shadow-sm">
            <div class=" d-flex justify-content-between">
                <div class="d-flex flex-wrap"><a href="{{route('street')}}">
                        <button type="button" class="btn helep_btn_raise">
                            <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                    </a></div>
                <div class="d-flex flex-wrap"></div>
                <div class="d-flex flex-wrap"></div>
            </div>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST"
                  action="{{route('update_street',['id'=>$street[0]->id])}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                	<h5 class="text-black-50 font-weight-bold  mb-2 p-2">Town</h5>
                	<div class="row">
                        <div class="col-md-8 ">                            
                            <div class="input-group border-with-radius mb-3">
                                <select  class="form-control" name="town_id">
                                	<option value=""> Select Town </option>
                                    @foreach($towns as $town)
                                    	<option value="{{$town->id}}" <?php echo $town->id==$street[0]->town_id?'selected="selected"':'';?>>{{$town->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 "></div>
                    </div>
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Street</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input value="{{$street[0]->name}}" name="name" type="text" class="form-control"
                                       placeholder="{{trans('admin.category_name')}}">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    
                    
                </div>
                <div class="align-self-start d-flex-column mt-4 mb-2">
                    <button class="btn helep_btn_raise px-5 w-100">{{trans('admin.update_street_btn')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#sidebar_manage_street").addClass('active');
        });
    </script>
@endsection
