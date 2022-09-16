@extends('helep.general.master')

@section('content')
    <div class="py-5 container-lg">
        <div class="ml-n2 mr-n5">
            <div class="card helep_round">
                <div class="card-body row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4 class="helep-text-color font-weight-bold">@lang('general.register_title_msg')</h4>
                        <form class="form-horizontal" method="post" action="{{route('signup')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="name"
                                           class="control-label">@lang('general.register_input_name_msg')</label>
                                </div>
                                <div class="col-md-10">
                                    <input value="{{old('name')}}" required name="name" type="text" class="form-control"
                                           id="name"
                                           placeholder="@lang('general.register_input_name_msg')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="email"
                                           class="control-label">@lang('general.login_input_email_msg')</label>
                                </div>
                                <div class="col-md-10">
                                    <input value="{{old('email')}}" required name="email" type="email"
                                           class="form-control" id="email"
                                           placeholder="@lang('general.login_input_email_msg')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="phone_number"
                                           class="control-label">@lang('general.register_label_contact_msg')</label>
                                </div>
                                <div class="col-md-10">
                                    <input value="{{old('phone_number')}}" name="phone_number" type="number"
                                           class="form-control"
                                           id="phone_number"
                                           placeholder="@lang('general.register_input_contact_number')">
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
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="password"
                                           class="control-label">@lang('general.register_input_confirm_password_msg')</label>
                                </div>
                                <div class="col-md-10">
                                    <input required name="password_confirmation" type="password" class="form-control"
                                           id="password"
                                           placeholder="@lang('general.register_input_confirm_password_msg')">
                                </div>
                            </div>
                            <div class="clearfix"><br/></div>
                            <div class="row">
                                <div class="col-md-10">
                                    <button type="submit" class="btn helep_btn_raise btn-block text-uppercase"><i
                                            class="zmdi zmdi-account-add mr-2"></i>@lang('general.register_btn_msg')
                                    </button>
                                    <div class="clearfix"><br/></div>
                                    <div class="text-center">
                                        <p>@lang('general.register_login_link_msg') </p>
                                        <a class="helep-text-color font-weight-bold" href="{{route('login_page')}}">
                                            @lang('general.login_title_msg')
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
