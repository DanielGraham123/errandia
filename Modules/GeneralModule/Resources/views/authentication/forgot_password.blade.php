@extends('helep.general.master')

@section('content')
    <div class="py-5 container-lg">
        <div class="ml-n2 mr-n5">
            <div class="card helep_round">
                <div class="card-body row">
                    @if(session('message'))
                        <div class="alert alert-success">{!! session('message') !!}</div>
                    @endif
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h4 class="helep-text-color text-center font-weight-bold">@lang('general.reset_password_title_msg')</h4>
                            <form class="form-horizontal" method="post" action="{{route('generate_password_link')}}">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-md-10">
                                        <label for="email"
                                               class="control-label font-weight-bold">@lang('general.login_input_email_reset_msg')</label>
                                        <br/>
                                        <input required name="email" type="email" class="form-control" id="email"
                                               placeholder="@lang('general.login_input_email_msg')">
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <div class="clearfix"><br/></div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <button type="submit" class="btn helep_btn_raise btn-block text-uppercase"><i
                                                class="zmdi zmdi-email mr-2"></i>@lang('general.reset_password_title_msg')
                                        </button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1 border-right"></div>
                    <div class="col-md-5">
                        <h4 class="helep-text-color text-center font-weight-bold">@lang('general.login_create_account_msg')</h4>
                        <div class="clearfix"><br/><br/></div>
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <p>@lang('general.login_create_account_p_msg')</p>
                                <div class="clearfix"><br/><br/></div>
                                <div class="m-1 text-center">
                                    <a href="{{route('signup_page')}}">
                                        <button class="btn helep_btn_raise btn-block text-uppercase"><i
                                                class="zmdi zmdi-email mr-2"></i>@lang('general.login_create_account_msg')
                                        </button>
                                    </a>
                                </div>
                                <div class="clearfix"><br/></div>
                                <div class="text-center m-1">
                                    <p>@lang('general.register_login_link_msg') </p>
                                    <a href="{{route('login_page')}}">
                                        <button class="btn helep_btn_raise btn-block text-uppercase"><i
                                                class="zmdi zmdi-email mr-2"></i>@lang('general.login_title_msg')
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
