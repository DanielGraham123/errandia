@extends('public.layout')
@section('section')
	    
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Create an Errandia Account</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Sign Up</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section section-b-space">
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
                            <h4>Stay at home & let's do the search</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" method="POST">
								@csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="name" value="{{ old('name') }}">
                                        <label for="fullname">Full Name</label>
                                        @if($errors->has('name'))
                                            @foreach($errors->get('name') as $error)
                                                <small style="color: red"><i class="fa fa-circle fa-xs"></i>&nbsp;{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                        <label for="email">Email Address</label>
                                        @if($errors->has('email'))
                                            @foreach($errors->get('email') as $error)
                                                <small style="color: red"><i class="fa fa-circle fa-xs"></i>&nbsp;{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

								<div class="col-12">
									<div class="input-group form-floating theme-form-floating">
										<select class="input-group-addon" name="phone_code" style="max-width: 7rem !important;">
											@foreach (config('country-phone-codes') as $phcode)
												<option value="+{{ $phcode['code'] }}" {{ old('phone_code') == $phcode ? 'selected' : '' }}>{{ $phcode['iso'] }} (+{{ $phcode['code'] }})</option>
											@endforeach
										</select>
										<input class="form-control" name="phone" value="{{old('phone')}}" type="number"  />
                                        <label for="email">Phone</label>
									</div>
                                    <div>
                                        @if($errors->has('phone'))
                                            @foreach($errors->get('phone') as $error)
                                                <small style="color: red"><i class="fa fa-circle fa-xs"></i>&nbsp;{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
								</div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                                        <span class="d-flex justify-content-end" style="position: absolute;top: 20px;left: 305px">
											<i class="fa fa-eye-slash" id="hidePassword" style="cursor: pointer"></i>
											<i class="fa fa-eye" id="showPassword" style="cursor: pointer;display: none"></i>
										   </span>
                                        <label for="password">Password</label>
                                        @if($errors->has('password'))
                                            @foreach($errors->get('password') as $error)
                                                <small class="error" style="color: red"><i class="fa fa-circle fa-xs"></i>&nbsp;{{$error}}</small><br/>
                                            @endforeach
                                            @if($error == "The password format is invalid.")
                                                    <div class="p-1">
                                                        <div>
                                                            <small style="color: red">
                                                                <i class="fa fa-circle fa-xs"></i>&nbsp;must be at least 8 characters in length
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <small style="color: red">
                                                                <i class="fa fa-circle fa-xs"></i>&nbsp;must contain at least one lowercase letter
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <small style="color: red">
                                                                <i class="fa fa-circle fa-xs"></i>&nbsp;must contain at least one uppercase letter
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <small style="color: red">
                                                                <i class="fa fa-circle fa-xs"></i>&nbsp;must contain at least one digit
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <small style="color: red">
                                                                <i class="fa fa-circle fa-xs"></i>&nbsp;must contain a special character
                                                            </small>
                                                        </div>
                                                    </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" id="confirm_password" name="password_confirmation"   placeholder="Confirm Password">
                                        <span class="d-flex justify-content-end" style="position: absolute;top: 20px;left: 310px">
											<i class="fa fa-eye-slash" id="hideConfirmPassword" style="cursor: pointer"></i>
											<i class="fa fa-eye" id="showConfirmPassword" style="cursor: pointer;display: none"></i>
										   </span>
                                        <label for="password">Confirm Password</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox" required
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">I agree with
                                                <a href="{{ route('public.privacy_policy', 'terms-condition') }}">Terms</a> and <a href="{{ route('public.privacy_policy', 'privacy-policy') }}">Privacy</a></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-animation w-100 theme-bg-color" type="submit" >Sign Up</button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>or</h6>
                        </div>

                        <div class="log-in-button">
                            <ul>
                                <li>
                                    <a href="{{route('google_redirect_link')}}"
                                        class="btn google-button w-100">
                                        <img src="{{ asset('assets/public/assets/images/inner-page/google.png') }}" class="blur-up lazyload"
                                            alt="">
                                        Sign up with Google
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/" class="btn google-button w-100">
                                        <img src="{{ asset('assets/public/assets/images/inner-page/facebook.png') }}" class="blur-up lazyload"
                                            alt=""> Sign up with Facebook
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
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

            $("#hideConfirmPassword").on("click", function (e){
                $("#hideConfirmPassword").css({"display": "none"})
                $("#showConfirmPassword").css({"display": "block"})
                $("#confirm_password").attr("type", "text")
            })
            $("#showConfirmPassword").on("click", function (e){
                $("#hideConfirmPassword").css({"display": "block"})
                $("#showConfirmPassword").css({"display": "none"})
                $("#confirm_password").attr("type", "password")
            })
        })
    </script>
@endsection