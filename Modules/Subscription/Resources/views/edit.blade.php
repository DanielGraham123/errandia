@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.subscriptions_update_title_msg') @endsection
@section('title') @lang('admin.subscriptions_update_title_msg') @endsection
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
                  action="{{route('update_subscription',['id'=>$subscription[0]->id])}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                	<h5 class="text-black-50 font-weight-bold  mb-2 p-2">Title</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input name="name" type="text" class="form-control"
                                       value="{{$subscription[0]->name}}">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Description</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group mb-3">
                                @include('helep.general.components.richtext_editor',['textareaName'=>'description','serverData'=>$subscription[0]->description])

                                {{--                                <textarea class="form-control html-editor" name="description" required placeholder="Description"> {!!$subscription[0]->description!!}</textarea>--}}
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Amount </h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input name="amount" type="text" class="form-control"
                                       placeholder="Amount"  value="{{$subscription[0]->amount}}">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Duration (Days)</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input name="duration" type="text" class="form-control"
                                       placeholder="Duration"  value="{{$subscription[0]->duration}}">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <div class="align-self-start d-flex-column mt-4 mb-2">
                    <button class="btn helep_btn_raise px-5 w-100">{{trans('admin.update_subscriptions_btn')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_subscription").addClass('active');
        });
    </script>
@endsection
