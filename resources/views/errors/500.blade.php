@extends('helep.general.master')
@section('page_title') @lang('general.500_page_title_msg') @endsection
@section("content")

    {{--500 page not found section--}}
    <div class="py-5 container-lg">
        <div class="ml-n2 mr-n5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card helep-text-color withripple">
                        <div class="card-body-big color-dark">
                            <div class="text-center">
                                <h3 class="helep-text-color text-center font-weight-bold">Server Error 500</h3>
                                <h2 class="font-weight-bold"> @lang('general.500_page_title_msg')</h2>
                                <p class="lead lead-sm">Our bad! Something has gone wrong. We are trying to fix it.<br>
                                    <small>Meanwhile you can go back to the homepage.</small>
                                </p>
                                <a href="{{url('/')}}" class="btn helep_btn_raise btn-block text-uppercase"><i
                                        class="zmdi zmdi-home"></i>
                                    Go Home</a>
                            </div>
                        </div>
                        <div class="ripple-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
