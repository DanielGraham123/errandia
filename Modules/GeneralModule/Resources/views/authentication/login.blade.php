@extends('helep.general.master')

@section('content')
    <div class="py-5 container-lg">
        <div class="ml-n2 mr-n5">
            <div class="card helep_round">
                @if(session('message'))
                    <div class="alert alert-success">{!! session('message') !!}</div>
                @endif
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h4 class="helep-text-color text-center font-weight-bold">@lang('general.login_title_msg')</h4>
                            <form class="form-horizontal" method="post" action="{{route('login_user')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="email"
                                               class="control-label">@lang('general.login_input_email_msg')</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input required name="email" type="email" class="form-control" id="email"
                                               placeholder="@lang('general.login_input_email_msg')">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="password"
                                               class="control-label">@lang('general.login_input_password_msg')</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input required name="password" type="password" class="form-control"
                                               id="password"
                                               placeholder="@lang('general.login_input_password_msg')">
                                    </div>
                                </div>
                                <div class="clearfix"><br/></div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <button type="submit" class="btn helep_btn_raise btn-block text-uppercase"><i
                                                class="zmdi zmdi-email mr-2"></i>@lang('general.login_btn_msg')
                                        </button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="clearfix"><br/></div>
                                <div class="font-weight-bold">
                                    <a class="helep-text-color" href="{{route('forgot_password_page')}}">@lang("general.reset_password_link_msg")</a>
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
                                        <button type="submit" class="btn helep_btn_raise btn-block text-uppercase"><i
                                                class="zmdi zmdi-email mr-2"></i>@lang('general.login_create_account_msg')
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
