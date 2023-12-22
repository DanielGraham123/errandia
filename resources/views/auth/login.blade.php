@extends('public.layout')
@section('section')
	    <!-- Breadcrumb Section Start -->
		<section class="breadscrumb-section pt-0">
			<div class="container-fluid-lg">
				<div class="row">
					<div class="col-12">
						<div class="breadscrumb-contain">
							<h2 class="mb-2">Log In</h2>
							<nav>
								<ol class="breadcrumb mb-0">
									<li class="breadcrumb-item">
										<a href="index.html">
											<i class="fa-solid fa-house"></i>
										</a>
									</li>
									<li class="breadcrumb-item active">Log In to Explore Errandia</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Breadcrumb Section End -->
	
		<!-- log in section start -->
		<section class="log-in-section background-image-2 section-b-space">
			<div class="container-fluid-lg w-100">
				<div class="row">
					<div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
						<div class="image-contain">
							<img src="{{ asset('assets/images/default1.jpg') }}" class="img-fluid" alt="">
						</div>
					</div>
	
					<div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
						<div class="log-in-box">
							<div class="log-in-title">
								<h3>Welcome To Errandia</h3>
								<h4>Stay at home & let's do the seach for you!</h4>
							</div>
	
							<div class="input-box">
								<form class="row g-4" method="POST" action="{{ route('login.submit') }}">
									@csrf
									<div class="col-12">
										<div class="form-floating theme-form-floating log-in-form">
											<input type="text" class="form-control" name="username" id="email" placeholder="Email Address">
											<label for="email">Email Address/Username</label>
											@if($errors->has('email'))
												@foreach($errors->get('email') as $error)
													<small style="color: red"><i class="fa fa-circle fa-xs"></i>&nbsp;{{ $error }}</small>
												@endforeach
											@endif
										</div>
									</div>
	
									<div class="col-12">
										<div class="form-floating theme-form-floating log-in-form">
											<input type="password" class="form-control" id="password" name="password"   placeholder="Password">
											<span class="d-flex justify-content-end" style="position: absolute;top: 20px;left: 305px">
											<i class="fa fa-eye-slash" id="hidePassword" style="cursor: pointer"></i>
											<i class="fa fa-eye" id="showPassword" style="cursor: pointer;display: none"></i>
										   </span>

											<label for="password">Password</label>
											@if($errors->has('password'))
												@foreach($errors->get('password') as $error)
													<small style="color: red"><i class="fa fa-circle fa-xs"></i>&nbsp;{{ $error }}</small>
												@endforeach
											@endif
										</div>
									</div>
	
									<div class="col-12">
										<div class="forgot-box">
											<div class="form-check ps-0 m-0 remember-box">
												<input class="checkbox_animated check-box" type="checkbox"
													id="flexCheckDefault">
												<label class="form-check-label" for="flexCheckDefault">Remember me</label>
											</div>
											<a href="{{ route('forgot_password') }}" class="forgot-password">Forgot Password?</a>
										</div>
									</div>
	
									<div class="col-12">
										<button class="btn btn-animation w-100 justify-content-center theme-bg-color" type="submit">Log
											In</button>
									</div>
								</form>
							</div>
	
							<div class="other-log-in">
								<h6>or</h6>
							</div>
	
							<div class="log-in-button">
								<ul>
									<li>
										<a href="{{route('google_redirect_link')}}" class="btn google-button w-100">
											<img src="{{ asset('assets/public/assets/images/inner-page/google.png') }}" class="blur-up lazyload"
												alt=""> Log In with Google
										</a>
									</li>
									{{-- <li>
										<a href="https://www.facebook.com/" class="btn google-button w-100">
											<img src="{{ asset('assets/public/assets/images/inner-page/facebook.png') }}" class="blur-up lazyload"
												alt=""> Log In with Facebook
										</a>
									</li> --}}
								</ul>
							</div>
	
							<div class="other-log-in">
								<h6></h6>
							</div>
	
							<div class="sign-up-box">
								<h4>Don't have an account?</h4>
								<a href="{{ route('register') }}">Sign Up</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- log in section end -->
	
@endsection
@section('script')
	<script>
		$(document).ready(function (e){
			$("#hidePassword").on("click", function (e){
				$("#hidePassword").css({"display": "none"})
				$("#showPassword").css({"display": "block"})
				$("#password").attr("type", "text")
			})
			$("#showPassword").on("click", function (e){
				$("#hidePassword").css({"display": "block"})
				$("#showPassword").css({"display": "none"})
				$("#password").attr("type", "password")
			})
		})
	</script>
@endsection