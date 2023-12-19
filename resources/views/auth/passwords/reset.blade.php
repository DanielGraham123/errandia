@extends('public.layout')
@section('section')
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2 class="mb-2">Reset Password</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Reset Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="log-in-section section-b-space forgot-section">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('assets/images/default1.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>Welcome To Errandia</h3>
                                <h4>Reset your password</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" method="POST" action="{{ route('reset_password', ['token' => $token]) }}">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating">
                                            <input type="email" class="form-control" id="email" name="email" disabled placeholder="Email Address" value="{{ $email }}">
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                                            <span class="d-flex justify-content-end" style="position: absolute;top: 20px;left: 330px">
											<i class="fa fa-eye-slash" id="hidePassword" style="cursor: pointer"></i>
											<i class="fa fa-eye" id="showPassword" style="cursor: pointer;display: none"></i>
										   </span>
                                            <label for="password">New Password</label>
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
                                            <input type="password" class="form-control" id="confirm_password" name="password_confirmation"   placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                                            <span class="d-flex justify-content-end" style="position: absolute;top: 20px;left: 330px">
											<i class="fa fa-eye-slash" id="hideConfirmPassword" style="cursor: pointer"></i>
											<i class="fa fa-eye" id="showConfirmPassword" style="cursor: pointer;display: none"></i>
										   </span>
                                            <label for="password">Confirm New Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">Save New Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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