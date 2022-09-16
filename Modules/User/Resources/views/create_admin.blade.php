@extends('helep.admin.layout.master')
@section('page_title') @lang('vendor.profile_user_page_title') @endsection
@section('title') @lang('vendor.profile_user_page_title') @endsection
@section('content')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <h4 class="helep-text-color font-weight-bold">@lang('admin.add_admin_title_msg')</h4>
                <form class="form-horizontal" method="post" action="{{route('add_admin_user')}}">
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
                            <button type="submit" class="btn helep_btn_raise text-uppercase"><i
                                    class="zmdi zmdi-account-add mr-2"></i>@lang('admin.add_admin_btn_msg')
                            </button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_admin").addClass('active');
        });
    </script>
@endsection
