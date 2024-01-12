<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>{!! $title ?? '' !!} | {{env('APP_NAME')}}</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{asset('assets/css/ace-part2.min.css')}}" class="ace-main-stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}"/>


    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css')}}" />


    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" class="ace-main-stylesheet" id="main-ace-style"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{ asset('tel_input_build/css/intlTelInput.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/quill-bs4') }}/css/quill.css">
    <link rel="stylesheet" href="{{ asset('assets/quill-bs4') }}/css/quill.snow.css">
    <link rel="stylesheet" href="{{ asset('assets/quill-bs4') }}/css/quill.bubble.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}

    {{-- <link rel="stylesheet" href="{{asset('richtexteditor/rte_theme_default.css')}}" />
    <script type="text/javascript" src="{{asset('/richtexteditor/rte.js')}}"></script>
    <script type="text/javascript" src="{{asset('/richtexteditor/plugins/all_plugins.js')}}"></script> --}}


    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({ selector:'textarea#text-editor1' });</script> --}}

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'powerpaste advcode table lists checklist',
        toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
    });
    </script>


    @php
        $bg1 = 'white';
        $bg2 = '#113d6b';
        $bg3 = '#091f36';
    @endphp
    <STYLE>
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* filter: brightness(105%); */
        }
        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }
        .dt-button{
            background-image: none!important;
            border: 1px solid #FFF;
            border-radius: 0;
            padding: 5px 20px;
            border-radius: 5px;
            box-shadow: none!important;
            -webkit-transition: background-color .15s,border-color .15s,opacity .15s;
            -o-transition: background-color .15s,border-color .15s,opacity .15s;
            transition: background-color .15s,border-color .15s,opacity .15s;
            vertical-align: middle;
            margin: 0;
            position: relative;
        }
        table{padding: 0px !important; filter: brightness(105%);}
        table th, table td{
            padding: 10px;
        }
        .table td{
            border-bottom: 1px  solid  #f1f1f1 !important;
        }
        .nav > li {
            display: block;
            width: 100% !important;
            font-size: 15px;
            font-weight: 600;
            color: var(--color-light) !important;
            background: {{ $bg2 }} !important;
        }
        .nav > li > a {
            color: var(--color-light) !important;
            background: {{ $bg2 }} !important;
        }
        .nav > li li {
            display: block;
            width: 100% !important;
            background: {{ $bg3 }} !important;
        }
        .nav > li li>a {
            color: var(--color-light) !important;
            background: {{ $bg3 }} !important;
        }
        .dropdown-toggle:after {
            display: none;
        }
        .menu-icon > img{
            width: 1.7rem; max-width: 1.7rem;
            height: 1.7rem; max-height: 1.7rem;
        }
        
        .dashboard-item{
            height: 14rem; width: 20rem; border-radius: 1rem; border: 1px solid #cfcfcf; box-shadow: 1px 1px #fadff3; background: white; padding: 1.3rem 0.9rem; margin: 1rem 0.7rem; display:inline-block;
        }
        .dashboard-item > .icon-box{
            height: fit-content; width: 100% !important;
        }
        .dashboard-item > .icon-box img{
            height: 5rem; width: 5rem; border-radius: 0.5rem; border: 1px solid #efefef; background: #efefef; display: block;
        }
        .dashboard-item .title{
            padding-block: 0.5rem; margin-bottom: 0.5rem; font-size: 15px; font-weight: 700; color: var(--color-black); display: block;
        }
        .dashboard-item .stats{
            padding-block: 0.5rem; display: flex; justify-content: space-between;
        }
        .dashboard-item .stats > .qty{
            padding-left: 1rem; font-size: 15px; font-weight: 700; color: var(--color-black);
        }
        .dashboard-item .stats .act{
            color: var(--color-lightblue); font-size: 15px; font-weight: 600;
        }
    </STYLE>

</head>
<body class="no-skin">
    <div class="pre-loader">
        <div class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
    </div>

    <div id="navbar" class="navbar navbar-default  ace-save-state py-0" style="background: {{$bg1}};">
        <div class="navbar-container w-100 ace-save-state py-0 my-0 d-flex d-md-block" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left display" id="menu-toggler"
                    data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left border-right px-md-5">
                <a class="navbar-brand">
                    <small style="color: white;">
                        <img src="{{ asset('assets/admin/logo/errandia-logo.png') }}" class="w-auto" style="height: 2.6rem;">
                    </small>
                </a>
            </div>
            <div class="navbar-header pull-left border-right px-2">
                <a class="navbar-brand">
                    <small class="text-body-sm"> <span class="hidden d-md-inline text-capitalize">visit errandia website</span>
                        <img src="{{ asset('assets/admin/icons/icon-external-link.svg') }}" class="w-auto" style="height: 1.3rem;" title="Visit Errandia Website">
                    </small>
                </a>
            </div>
            <div class="navbar-header pull-left border-right px-2 d-md-inline">
                <a class="navbar-brand" title="Add New">
                    <small class="text-body-sm"> 
                        <img src="{{ asset('assets/admin/icons/icon-add.svg') }}" class="w-auto" style="height: 1.3rem;">
                        {{-- <span class=" text-capitalize mx-2">add new</span>
                        <img src="{{ asset('assets/admin/icons/icon-dropdown.svg') }}" class="w-auto" style="height: 1.3rem;"> --}}
                    </small>
                </a>
            </div>





            <div class="navbar-header pull-right border-right px-2">
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="navbar-brand border-0 bg-white">
                        <small class="text-body-sm"> 
                            <span class="hidden d-md-inline text-capitalize">Logout</span>
                            <img src="{{ asset('assets/admin/icons/icon-logout.svg') }}" class="w-auto" style="height: 1.7rem;" title="Logout">
                        </small>
                    </button>
                </form>
            </div>
            <div class="navbar-header pull-right border-right px-2">
                <a class="navbar-brand">
                    <small class="text-body-sm"> 
                        <img src="{{ asset('assets/admin/images/admin-profile-pic.png') }}" class="w-auto" style="height: 2.2rem; border-radius: 50% !important;" title="Profile">
                        <span class="hidden d-md-inline text-capitalize">Johnson</span>
                    </small>
                </a>
            </div>
            <div class="navbar-header pull-right border-right px-1">
                <a class="navbar-brand">
                    <small class="text-body-sm"> 
                        <img src="{{ asset('assets/admin/icons/icon-notifications.svg') }}" class="w-auto" style="height: 2.2rem;" title="notifications">
                    </small>
                </a>
            </div>

        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">

        <div id="sidebar" class="sidebar responsive ace-save-state" style="background: {{ $bg2 }} !important;">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {
                }
            </script>

            <div class="sidebar-shortcuts" id="sidebar-shortcuts" style="background: {{ $bg2 }} !important;">
                <div>
                    <h5></h5>
                </div>
            </div><!-- /.sidebar-shortcuts -->
            <ul class="nav nav-list" style="background-color: {{$bg3}};">
                <li style="background: {{ $bg2 }};">
                    <a href="{{route('admin.home')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-dashboard.svg') }}"></span>
                        <span class="menu-text text-capitalize">Dashboard</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <li>
                    <a
                        href="{{route('admin.errands.index')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-errands.svg') }}"></span>
                        <span class="menu-text text-capitalize">Errands</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                      
                <li>
                    <a href="" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-business-locations.svg') }}"></span>
                        <span class="menu-text">Business Locations</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.locations.towns') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Manage Towns
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li>
                            <a href="{{ route('admin.locations.streets') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Manage Streets
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                
            
                <li>
                    <a href="" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-businesses.svg') }}"></span>
                        <span class="menu-text">Businesses</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.businesses.create') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add New
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li>
                            <a href="{{ route('admin.businesses.index') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                All Businesses
                            </a>
                            <b class="arrow"></b>
                        </li>


                    </ul>
                </li>

                <li>
                    <a
                        href="{{route('admin.products.index')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-products.svg') }}"></span>
                        <span class="menu-text text-capitalize">Products</span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <li>
                    <a
                        href="{{route('admin.services.index')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-services.svg') }}"></span>
                        <span class="menu-text text-capitalize">Services</span>
                    </a>
                    <b class="arrow"></b>
                </li>

                        
                <li>
                    <a href="" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-dashboard.svg') }}"></span>
                        <span class="menu-text">Manage Categories</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                All Categories
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.sub_categories') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Sub-Categories
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                  
                <li>
                    <a
                        href="{{route('admin.reviews.index')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-dashboard-review.svg') }}"></span>
                        <span class="menu-text text-capitalize">Manage Reviews</span>
                    </a>
                    <b class="arrow"></b>
                </li>

    
                <li>
                    <a href="#" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-manage-users.svg') }}"></span>
                        <span class="menu-text">Manage Users</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>


                    <ul class="submenu">
                        <li>
                            <a href="{{route('admin.users.index')}}?type=admin" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{trans_choice('text.add_admin', 2)}}
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{route('admin.roles.index')}}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                            {{trans_choice('text.role', 2)}}
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.create') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add New User
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.users.index') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                All Users
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
                @endif --}}
    
                <li>
                    <a href="#" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-manage-admins.svg') }}"></span>
                        <span class="menu-text">Manage Admins</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.admins.index') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                All Admins
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.admins.roles') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Manage Roles
                            </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
                @endif --}}

                            
                <li>
                    <a
                        href="{{route('admin.plans.index')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-subscription-plans.svg') }}"></span>
                        <span class="menu-text text-capitalize">Subscription Plans</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                            
                <li>
                    <a
                        href="{{route('admin.sms_bundles.index')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-sms-bundles.svg') }}"></span>
                        <span class="menu-text text-capitalize">SMS Bundles</span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-reports.svg') }}"></span>
                        <span class="menu-text">Reports</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.reports.subscription') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Subscriptions
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.reports.sms') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                SMS
                            </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
                @endif --}}

                <li>
                    <a href="#" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-settings.svg') }}"></span>
                        <span class="menu-text">Settings</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.settings.profile') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                My Profile
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.settings.footer') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Manage Footer
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.settings.change_password') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                            Change Password
                            </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
                @endif --}}

                <li>
                    <a href="#" class="dropdown-toggle text-capitalize">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-manage-pages.svg') }}"></span>
                        <span class="menu-text">Manage Pages</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.pages.index') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                All Pages
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li>
                            <a href="{{ route('admin.pages.privacy') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Privacy Policies
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.pages.team_members') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Team Members
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="{{ route('admin.faqs.index') }}" class="text-capitalize">
                                <i class="menu-icon fa fa-caret-right"></i>
                                FAQs
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
                @endif --}}

                <li>
                    <a href="{{route('admin.abuse.reports')}}">
                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-business-locations.svg') }}"></span>
                        <span class="menu-text text-capitalize">Abuse Reports</span>
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>


            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse" style="background: {{ $bg2 }} !important;">
                <i id="sidebar-toggle-icon" class="ace-icon f ace-save-state"></i>
            </div>
        </div>
        <div class="main-content">
            <div class="main-content-inner">

                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb text-capitalize">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">{{__('text.word_home')}}</a>
                        </li>
                        <li class="active">{{__('text.word_dashboard')}}</li>
                        <li class="active"> {{__('text.fullname')}} : <b style="color: #e30000">{{\auth('admin')->user()->name}}</b></li>

                    </ul><!-- /.breadcrumb -->
                </div>

                <div class="mx-5 my-3">
                    <div style="max-height: 65vh; overflow:auto">
                        @if(Session::has('success'))
                            <div class="alert alert-success fade in">
                                <strong>Success!</strong> {{Session::get('success')}}
                            </div>
                        @endif
        
                        @if(Session::has('error'))
                            <div class="alert alert-danger fade in">
                                <strong>Error!</strong> {{Session::get('error')}}
                            </div>
                        @endif
        
                        @if(Session::has('message'))
                            <div class="alert alert-primary fade in">
                                <strong>Message!</strong> {!! Session::get('message') !!}
                            </div>
                        @endif
                    </div>

                    <div id="modal-box"></div>

                    <div class="mb-4 mx-3">
                        <h4 id="title" class="font-weight-bold text-capitalize">{!! $title ?? '' !!}</h4>
                    </div>
                        @yield('section')
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content" style="background: transparent;">
                <span class="bigger-120">
                Copyright &copy; 2023 Errandia.cm. All rights reserved
                </span>
                &nbsp; &nbsp;
                
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
    </div>

<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/spinbox.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/js/autosize.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.inputlimiter.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-tag.min.js') }}"></script>


<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
{{-- <script src="{{asset('assetsassets/js/jquery-3.6.0.min.js')}}"></script> --}}
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{asset('assets/js/ace.min.js')}}"></script>
<script src="{{ asset('libs')}}/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
<script src="{{ asset('tel_input_build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('tel_input_build/js/intlTelInput-jquery.min.js') }}"></script>

{{-- 
<script src="{{ asset('assets/public/assets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/quill-bs4/sprite.svg.js') }}"></script>
<script src="{{ asset('assets/quill-bs4/bootstrap-quill.js') }}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    var toolbarOptions = [
        [{
        'header': [1, 2, 3, 4, 5, 6, false]
        }],
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block'],

        [{
        'header': 1
        }, {
        'header': 2
        }], // custom button values
        [{
        'list': 'ordered'
        }, {
        'list': 'bullet'
        }],
        [{
        'script': 'sub'
        }, {
        'script': 'super'
        }], // superscript/subscript
        [{
        'indent': '-1'
        }, {
        'indent': '+1'
        }], // outdent/indent
        [{
        'direction': 'rtl'
        }], // text direction

        [{
        'size': ['small', false, 'large', 'huge']
        }], // custom dropdown

        [{
        'color': []
        }, {
        'background': []
        }], // dropdown with defaults from theme
        [{
        'font': []
        }],
        [{
        'align': []
        }],
        ['link', 'image'],

        ['clean'] // remove formatting button
    ];

    var quillFull = new Quill('#quill_editor_1', {
        modules: {
            toolbar: toolbarOptions,
            autoformat: true
        },
        theme: 'snow',
        placeholder: "Write something..."
    });
    var quillFull = new Quill('#quill_editor_2', {
        modules: {
            toolbar: toolbarOptions,
            autoformat: true
        },
        theme: 'snow',
        placeholder: "Write something..."
    });
</script> --}}


<script>
    $(function () {
        $('.table , .adv-table table').DataTable(
            {
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                 // 'copy', 'csv', 'excel',
                {
                    // text: 'Download PDF',
                    // extend: 'pdfHtml5',
                    // message: '',
                    // orientation: 'portrait',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (doc) {
                        doc.pageMargins = [10,10,10,10];
                        doc.defaultStyle.fontSize = 7;
                        doc.styles.tableHeader.fontSize = 7;
                        doc.styles.title.fontSize = 9;
                        doc.content[0].text = doc.content[0].text.trim();

                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    "{!! $title ?? '' !!}",
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                    }
                                ],
                                margin: [10, 0]
                            }
                        });
                        // Styling the table: create style object
                        var objLayout = {};
                        // Horizontal line thickness
                        objLayout['hLineWidth'] = function(i) { return .5; };
                        // Vertikal line thickness
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        // Horizontal line color
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        // Vertical line color
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        // Left padding of the cell
                        objLayout['paddingLeft'] = function(i) { return 4; };
                        // Right padding of the cell
                        objLayout['paddingRight'] = function(i) { return 4; };
                        // Inject the object in the document
                        doc.content[1].layout = objLayout;
                    }
                }

            ],
            info:     true,
            searching: true,
            lengthMenu: [[10, 25, 50, -1],[10, 25, 50, 'All']],
        });



        $('form').each((index, element)=>{
            $(element).on('submit', (event)=>{
                // $(element).
                // event.preventDefault();
                let submit_btn = $(element).find("button, input[type='submit']").first();
                $(submit_btn).prop('disabled', 'true');
            })
        });
    });

    function delete_alert(event, data) {
        event.preventDefault();
        let yes = confirm('You are about to delete an item:'+data+'. This operation can not be reversed. Delete item?');
        if(yes){
            window.location = event.target.href;
        }
    }
    $('#menu-toggler').on('click', function(){
        $('#sidebar').toggleClass('d-block');
    })

    
    let _prompt = function(url = null, question = null){
        // 
        let markup = `<div id="confirm-modal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <div class="icon-box">
                                <i class="" style="font-size: 12rem; font-weight: light;">&times;</i>
                            </div>						
                            <h4 class="modal-title w-100">Are you sure?</h4>	
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>${question}</p>
                        </div>
                        <div class="modal-footer bg-white justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="${url}">
                                <button type="submit" class="btn btn-danger" onclick="redirect()">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>`;
        $('#modal-box').html(markup);
        $('#confirm-modal').modal('show');
    }

</script>

<script src="{{ asset('libs')}}/datatables.net/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/jszip.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/pdfmake.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/vfs_fonts.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/buttons.html5.min.js"></script>

<script>
    (function($){
        'use strict';
        $(window).on('load', function () {
            if ($(".pre-loader").length > 0)
            {
                $(".pre-loader").fadeOut("slow");
            }
        });
    })(jQuery)

    $(".telephone").intlTelInput({
        utilsScript: "{{ asset('tel_input_build/js/utils.js') }}"
    });
</script>
@yield('script')

<script type="text/javascript">
    jQuery(function($) {
        $('#id-disable-check').on('click', function() {
            var inp = $('#form-input-readonly').get(0);
            if(inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly' , 'true');
                inp.removeAttribute('disabled');
                inp.value="This text field is readonly!";
            }
            else {
                inp.setAttribute('disabled' , 'disabled');
                inp.removeAttribute('readonly');
                inp.value="This text field is disabled!";
            }
        });
    
    
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true}); 
            //resize the chosen on window resize
    
            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                })
            });
    
    
            $('#chosen-multiple-style .btn').on('click', function(e){
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                    else $('#form-field-select-4').removeClass('tag-input-style');
            });
        }
    
    
        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});
    
        autosize($('textarea[class*=autosize]'));
        
        $('textarea.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });
    
        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
    
    
    
        $( "#input-size-slider" ).css('width','200px').slider({
            value:1,
            range: "min",
            min: 1,
            max: 8,
            step: 1,
            slide: function( event, ui ) {
                var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                var val = parseInt(ui.value);
                $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
            }
        });
    
        $( "#input-span-slider" ).slider({
            value:1,
            range: "min",
            min: 1,
            max: 12,
            step: 1,
            slide: function( event, ui ) {
                var val = parseInt(ui.value);
                $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
            }
        });
    
    
        
        //"jQuery UI Slider"
        //range slider tooltip example
        $( "#slider-range" ).css('height','200px').slider({
            orientation: "vertical",
            range: true,
            min: 0,
            max: 100,
            values: [ 17, 67 ],
            slide: function( event, ui ) {
                var val = ui.values[$(ui.handle).index()-1] + "";
    
                if( !ui.handle.firstChild ) {
                    $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                    .prependTo(ui.handle);
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('span.ui-slider-handle').on('blur', function(){
            $(this.firstChild).hide();
        });
        
        
        $( "#slider-range-max" ).slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2
        });
        
        $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
            // read initial values from markup and remove that
            var value = parseInt( $( this ).text(), 10 );
            $( this ).empty().slider({
                value: value,
                range: "min",
                animate: true
                
            });
        });
        
        $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
    
        
        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });
        //pre-show a file name, for example a previously selected file
        //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
    
    
        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small'//large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
                //Check an example below
                //or examples/file-upload.html
                return true;
            }*/
            /**,before_remove : function() {
                return true;
            }*/
            ,
            preview_error : function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }
    
        }).on('change', function(){
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });
        
        
        //$('#id-input-file-3')
        //.ace_file_input('show_file_list', [
            //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
            //{type: 'file', name: 'hello.txt'}
        //]);
    
        
        
    
        //dynamically change allowed formats by changing allowExt && allowMime function
        $('#id-file-format').removeAttr('checked').on('change', function() {
            var whitelist_ext, whitelist_mime;
            var btn_choose
            var no_icon
            if(this.checked) {
                btn_choose = "Drop images here or click to choose";
                no_icon = "ace-icon fa fa-picture-o";
    
                whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
                whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
            }
            else {
                btn_choose = "Drop files here or click to choose";
                no_icon = "ace-icon fa fa-cloud-upload";
                
                whitelist_ext = null;//all extensions are acceptable
                whitelist_mime = null;//all mimes are acceptable
            }
            var file_input = $('#id-input-file-3');
            file_input
            .ace_file_input('update_settings',
            {
                'btn_choose': btn_choose,
                'no_icon': no_icon,
                'allowExt': whitelist_ext,
                'allowMime': whitelist_mime
            })
            file_input.ace_file_input('reset_input');
            
            file_input
            .off('file.error.ace')
            .on('file.error.ace', function(e, info) {
                //console.log(info.file_count);//number of selected files
                //console.log(info.invalid_count);//number of invalid files
                //console.log(info.error_list);//a list of errors in the following format
                
                //info.error_count['ext']
                //info.error_count['mime']
                //info.error_count['size']
                
                //info.error_list['ext']  = [list of file names with invalid extension]
                //info.error_list['mime'] = [list of file names with invalid mimetype]
                //info.error_list['size'] = [list of file names with invalid size]
                
                
                /**
                if( !info.dropped ) {
                    //perhapse reset file field if files have been selected, and there are invalid files among them
                    //when files are dropped, only valid files will be added to our file array
                    e.preventDefault();//it will rest input
                }
                */
                
                
                //if files have been selected (not dropped), you can choose to reset input
                //because browser keeps all selected files anyway and this cannot be changed
                //we can only reset file field to become empty again
                //on any case you still should check files with your server side script
                //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
            });
            
            
            /**
            file_input
            .off('file.preview.ace')
            .on('file.preview.ace', function(e, info) {
                console.log(info.file.width);
                console.log(info.file.height);
                e.preventDefault();//to prevent preview
            });
            */
        
        });
    
        $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function(){
            //console.log($('#spinner1').val())
        }); 
        $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
        $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
        $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
    
        //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
        //or
        //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
        //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
    
    
        //datepicker plugin
        //link
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
    
        //or change it into a date range picker
        $('.input-daterange').datepicker({autoclose:true});
    
    
        //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
        $('input[name=date-range-picker]').daterangepicker({
            'applyClass' : 'btn-sm btn-success',
            'cancelClass' : 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        })
        .prev().on(ace.click_event, function(){
            $(this).next().focus();
        });
    
    
        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            disableFocus: true,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            }
        }).on('focus', function() {
            $('#timepicker1').timepicker('showWidget');
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        
        
    
        
        if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
            //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
            icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
            }
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        
    
        $('#colorpicker1').colorpicker();
        //$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
    
        $('#simple-colorpicker-1').ace_colorpicker();
        //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
        //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
        //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
        //picker.pick('red', true);//insert the color if it doesn't exist
    
    
        $(".knob").knob();
        
        
        var tag_input = $('#form-field-tags');
        try{
            tag_input.tag(
                {
                placeholder:tag_input.attr('placeholder'),
                //enable typeahead by specifying the source array
                source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                /**
                //or fetch data from database, fetch those that match "query"
                source: function(query, process) {
                    $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                    .done(function(result_items){
                    process(result_items);
                    });
                }
                */
                }
            )
    
            //programmatically add/remove a tag
            var $tag_obj = $('#form-field-tags').data('tag');
            $tag_obj.add('Programmatically Added');
            
            var index = $tag_obj.inValues('some tag');
            $tag_obj.remove(index);
        }
        catch(e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //autosize($('#form-field-tags'));
        }
        
        
        /////////
        $('#modal-form input[type=file]').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'ace-icon fa fa-cloud-upload',
            droppable:true,
            thumbnail:'large'
        })
        
        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('shown.bs.modal', function () {
            if(!ace.vars['touch']) {
                $(this).find('.chosen-container').each(function(){
                    $(this).find('a:first-child').css('width' , '210px');
                    $(this).find('.chosen-drop').css('width' , '210px');
                    $(this).find('.chosen-search input').css('width' , '200px');
                });
            }
        })
        /**
        //or you can activate the chosen plugin after modal is shown
        //this way select element becomes visible with dimensions and chosen works as expected
        $('#modal-form').on('shown', function () {
            $(this).find('.modal-chosen').chosen();
        })
        */
    
        
        
        $(document).one('ajaxloadstart.page', function(e) {
            autosize.destroy('textarea[class*=autosize]')
            
            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });
    
    });
</script>
</body>
</html>