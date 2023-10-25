<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{config('app.name')}}</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
		<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script> -->

		@php
			$bg1 = 'blue';
			$bg2 = 'red';
			$bg3 = 'white';
		@endphp

		<style>
			body{
				background-image: url("{{asset('assets/images/background1.png')}}");
				background-position: center;
				background-size: cover;
				background-repeat: no-repeat;
				background-attachment: fixed;


			}

				/* Rectangle 23 */
			#login-frame{
				position: relative;
				width: 350px;
				height: 450px;
				min-height: fit-content;
				margin-inline: auto;
				border-radius: 24px;
			}
				/* Rectangle 23 */
			#login-frame .rect1{
				position: absolute;
				width: 100%;
				height: 100%;
				min-height: fit-content;
				background: #113d6b;
				border-radius: 24px;
				top: -9px;
			}

				/* Rectangle 22 */
			#login-frame .rect2{
				position: absolute;
				width: 100%;
				height: 100%;
				min-height: fit-content;
				margin-inline: auto;
				background: #091f36;
				box-shadow: 0px 0px 34px rgba(0, 0, 0, 0.25);
				border-radius: 24px;
				left: 9px;
			}
				/* input bg */
			#login-frame .main-rect{
				position: absolute;
				width: 100%;
				height: 100%;
				min-height: fit-content !important;
				background-color: white;
				border-radius: 24px;
			}

			#login-frame .main-rect div{
				background-color: white;
			}




		    a{
		        text-decoration:none;
		        font-weight:bold;
		        font-size:16px;
		        color:#fff;
		    }
		</style>
	</head>

	<body class="login-layout" id="frame">
		<div class="main-container px-5" style="padding-inline: 2rem;">
			<div class="py-5 mx-5 w-100 text-uppercase text-center" style="padding: 2rem; font-weight: bolder; vertical-align: middle;">
				<h3> <span style="color: white; text-shadow: -1px -1px 0 #113d6b, 1px -1px 0 #113d6b, -1px 1px 0 #113d6b, 1px 1px 0 #113d6b; font-weight: bolder; font-size: xx-large;">Errandia Login</span></h3>
			</div>
			<div class="main-content">
				<div class="w-100">
						<div class="login-container" id="login-frame">

							<div class="rect1"></div>

				  			<div class="rect2"></div>
							<div class="position-relative main-rect " >
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="bigger text-capitalize text-center" style="color: #113d6b; font-size: 29.44px;">
											 	<b>{{__('text.log_in')}}</b>
											</h4>

											@if(Session::has('error'))
												<div class="alert alert-danger"><em> {!! session('error') !!}</em>
												</div>
											@endif


											@if(Session::has('e'))
												<div class="alert alert-danger"><em> {!! session('e') !!}</em>
												</div>
											@endif

											@if(Session::has('s'))
												<div class="alert alert-success"><em> {!! session('s') !!}</em>
												</div>
											@endif
											<div class="space-6"></div>

											<form method="post" action="{{route('login.submit')}}">
											@csrf
												<fieldset style="color: black;">
													<label class="block clearfix">
														<span class="text-capitalize">{{__('text.word_name')}}</span>
														<span class="block input-icon input-icon-right" style="background-color: white !important;">
															<input type="text" required class="form-control" value="{{old("name")}}" name="name" style="border-radius: 0.5rem !important; background-color: white !important; color: black" />
														</span>
														@error('name')
															<span class="invalid-feedback red" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</label>
													<label class="block clearfix">
														<span class="text-capitalize">{{__('text.word_phone')}}</span>
														<span class="block input-icon input-icon-right" style="background-color: white !important;">
															<input type="tel" required class="form-control" value="{{old("phone")}}" name="phone" style="border-radius: 0.5rem !important; background-color: white !important; color: black" />
														</span>
														@error('phone')
															<span class="invalid-feedback red" role="alert">
																<strong>{{ $phone }}</strong>
															</span>
														@enderror
													</label>
													<div class="space"></div>
													<label class="block clearfix">
														<span class="text-capitalize">{{__('text.word_password')}}</span>
														<span class="block input-icon input-icon-right">
															<input  type="password" id="password" name="password" data-toggle="password" required class="form-control" style="border-radius: 0.5rem !important; background-color: white !important; color: black"/>
														</span>
														@error('password')
															<span class="invalid-feedback red" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<button type="submit" class="form-control btn-black btn-sm" style="border-radius: 0.4rem; background-color: #091f36; border: 1px solid black; color: white;">
															{{-- <i class="ace-icon fa fa-key"></i> --}}
															<span class="bigger-110">{{__('text.register')}}</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="clearfix toolbar"  style=" border: 0px;  font-size: xsmall !important; width: 77% !important; margin-inline: auto; ">
											
												<a  href="#" data-target="#forgot-box" class="text-center form-control btn-black btn-sm" style="border-radius: 0.4rem; background-color: #091f36; border: 1px solid black; color: white; font-weight: normal !important;">
													<span class="bigger-110">{{__('text.word_login')}}</span>
												</a>
											<div>
											</div>

										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div>
						</div>
				</div><!-- /.row -->
			</div><!-- /.main-content -->

			<div style="display: flex; justify-content: center; padding-block: 3rem; text-align: center; text-transform: capitalize; color: black !important;">
				<span>{{__('text.powered_by')}} <b> {{__('text.nishang_system')}} </b></span>
			</div>
		</div><!-- /.main-container -->


				</div>
		<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('assets/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>
		<script type="text/javascript">

$("#password").password('toggle');

</script>

	</body>
</html>
