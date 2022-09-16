@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.manage_site_page_title') @endsection
@section('title') @lang('admin.manage_site_page_title') @endsection
@section('content')
    <div class="container p-2">
        <div class="p-2 shadow-sm">
            <div class=" d-flex justify-content-between">
                <div class="d-flex flex-wrap"></div>
                <div class="d-flex flex-wrap"></div>
                <div class="d-flex flex-wrap"></div>
            </div>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST" action="{{route('save_about_us_page')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">About Us Page Content</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group mb-3">
                                <textarea class="form-control html-editor" name="about_us" required
                                          placeholder="Description"> {{!empty($siteData) ? $siteData->about_page :""}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button
                        class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.save_site_page_btn')}}</button>
                </div>
            </form>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST" action="{{route('save_help_center_page')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Help Center Content</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group mb-3">
                                <textarea class="form-control html-editor" name="help_center" required
                                          placeholder="Page Content">
                                    {{!empty($siteData) ? $siteData->help_center :""}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button
                        class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.save_site_page_btn')}}</button>
                </div>
            </form>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST" action="{{route('save_policy_page')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Policies and Rules Page Content</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group mb-3">
                                <textarea class="form-control html-editor" name="policy_page" required
                                          placeholder="Page Description">
                                     {{!empty($siteData) ? $siteData->policy_page :""}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button
                        class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.save_site_page_btn')}}</button>
                </div>
            </form>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST" action="{{route('save_report_page')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Report Abuse Page Content</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group mb-3">
                                <textarea class="form-control html-editor" name="report_page" required
                                          placeholder="Page Description">
                                    {{!empty($siteData) ? $siteData->report_page :""}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button
                        class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.save_site_page_btn')}}</button>
                </div>
            </form>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST" action="{{route('save_disclaimer_page')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Disclaimers Page Content</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group mb-3">
                                <textarea class="form-control html-editor" name="disclaimer_page" required
                                          placeholder="Page Content">
                                     {{!empty($siteData) ? $siteData->disclaimer_page :""}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button
                        class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.save_site_page_btn')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{asset('summernote/dist/summernote.css')}}" rel="stylesheet">
@stop
@section('js')
    <script src="{!!asset("summernote/dist/summernote-updated.min.js")!!}"></script>
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_site_page").addClass('active');
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
