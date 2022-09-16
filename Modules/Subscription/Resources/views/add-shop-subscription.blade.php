@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.package_add_title_msg') @endsection
@section('title') @lang('admin.package_add_title_msg') @endsection
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
            <form enctype="multipart/form-data" method="POST" action="{{route('save_shop_package')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Shop </h5>
                    <div class="row">
                        <div class="col-md-8 ">
                    <select class="form-control" name="shop_id" id="shop_id">
                        <option value="none">Select Shop</option>

                        @foreach($shops as $shop)
                            <option value="{{$shop->id}}" >{{$shop->name}}</option>
                        @endforeach

                    </select>
						</div>
                     </div>
                    
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Subscription Package </h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <select class="form-control" name="subscription_id" id="subscription_id">
                                <option value="none">Select Package</option>
    
                                @foreach($subscriptions as $subscription)
                                    <option value="{{$subscription->id.'|'.$subscription->duration}}" >{{$subscription->name.' $'.$subscription->amount}}</option>
                                @endforeach
        
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.activate_subscriptions_btn')}}</button>
                </div>
            </form>
        </div>
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
            $("#admin_manage_shop_subscription").addClass('active');
			loadHtmlEditor();
        });
		
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
