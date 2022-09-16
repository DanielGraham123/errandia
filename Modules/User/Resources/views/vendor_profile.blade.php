@extends('helep.vendor.layout.master')
@section('page_title') @lang('vendor.profile_page_title') @endsection
@section('title') @lang('vendor.profile_page_title') @endsection
@section('content')
    <div class="container py-2">
        {{--        Shop Details--}}
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="ms-hero-bg-primary ms-hero-img-coffee">
                        <h3 class="color-white index-1 text-center no-m pt-1">{{$shop->user->name}}</h3>
                        <div class="color-medium index-1 text-center np-m">{{ $shop->user->email }}</div>
                        <img src="{{asset('storage/'.$shop->image_path)}}" alt="..."
                             class="img-avatar-circle mt-n4">
                    </div>
                    <div class=" pt-4 text-center">
                        <h3 class="color-primary">{{$shop->name}}</h3>
                        <p>{{$shop->description}}.</p>
                        <div class="card card-light">
                            <div class="card-header">
                                <h3 class="card-title">@lang('shop.shop_info_general_title')</h3>
                            </div>
                            <table class="table table-no-border table-striped">
                                <tr>
                                    <th>
                                        <i class="zmdi zmdi-face mr-1 color-success"></i>@lang('shop.add_shop_placeholder_full_name')
                                    </th>
                                    <td>{{$shop->user->name}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="zmdi zmdi-account mr-1 color-warning"></i>@lang('shop.shop_list_category_msg')
                                    </th>
                                    <td>{{$shop->category->name}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="zmdi zmdi-my-location mr-1 color-danger"></i> @lang('shop.add_shop_placeholder_address')
                                    </th>
                                    <td><a>{{$address}}</a></td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="zmdi zmdi-link mr-1 color-info"></i>@lang('shop.add_shop_placeholder_website')
                                    </th>
                                    <td><a target="_blank"
                                           href="{{$shop->shopContactInfo->website_link}}">{{$shop->shopContactInfo->website_link}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="zmdi zmdi-calendar mr-1 color-royal"></i>@lang('shop.shop_info_reg_date_msg')
                                    </th>
                                    <td>{{$shop->created_at->diffForHumans()}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--        Update shop business info--}}
        @include('user::layouts.update_business_info',['shop'=>$shop])
        {{--                   Update sop owner personal info--}}
        @include('user::layouts.change_password',['user'=>$shop->user])
        {{--        Change user password--}}
        <div class="row">

        </div>
    </div>
@endsection
<link href="{{asset('summernote/dist/summernote.css')}}" rel="stylesheet">
@section('js')
<script src="{!!asset("summernote/dist/summernote-updated.min.js")!!}"></script>
    <script>
        $(function () {
            //set link indicator
            $("#profile").addClass('active');
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
