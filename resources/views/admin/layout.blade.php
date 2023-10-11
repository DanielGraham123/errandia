<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>{!! $title ?? '' !!} | {{__('text.app_name')}}</title>

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



    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" class="ace-main-stylesheet" id="main-ace-style"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{ asset('tel_input_build/css/intlTelInput.css') }}" rel="stylesheet">

    @php
        $bg1 = 'white';
        $bg2 = '#113d6b';
        $bg3 = '#091f36';
    @endphp
    <STYLE>
        body {
            font-family: Arial, Helvetica, sans-serif;
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
        table{padding: 0px !important}
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
            height: 14rem; width: 20rem; border-radius: 1rem; border: 1px solid #eeeeee; box-shadow: 1px 1px #efefef; background: white; padding: 1.3rem 0.9rem; margin: 1rem auto; display:inline-block;
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
            <a href="{{ route('logout') }}" class="navbar-brand">
                <small class="text-body-sm"> 
                    <span class="hidden d-md-inline text-capitalize">Logout</span>
                    <img src="{{ asset('assets/admin/icons/icon-logout.svg') }}" class="w-auto" style="height: 1.7rem;" title="Logout">
                </small>
            </a>
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
                <a
                    href="{{route('admin.locations.streets')}}">
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
            {{-- @if (\Auth::user()->hasPermissionTo('manage_user'))
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
            {{-- @if (\Auth::user()->hasPermissionTo('manage_user'))
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
            {{-- @if (\Auth::user()->hasPermissionTo('manage_user'))
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
            {{-- @if (\Auth::user()->hasPermissionTo('manage_user'))
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
                        <a href="{{ route('admin.pages.team_members') }}" class="text-capitalize">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Team Members
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            {{-- @if (\Auth::user()->hasPermissionTo('manage_user'))
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
                    <li class="active"> {{__('text.fullname')}} : <b style="color: #e30000">{{\Auth::user()->name}}</b></li>

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


                <div class="mb-4 mx-3">
                    <h4 id="title" class="font-weight-bold text-capitalize">{!! $title ?? '' !!}</h4>
                </div>
                @if ((auth()->user()->password_reset != 1) && (now()->diffInDays(\Illuminate\Support\Carbon::createFromTimestamp(auth()->user()->created_at)) >= 14) && (url()->current() != route('admin.reset_password')))
                    <div class="py-5 h3 text-center text-danger mt-5 text-capitalize">{{__('text.password_reset_request')}}</div>
                    <div class="py-3 d-flex justify-content-center mt-2">
                        <a class="btn btn-lg col-sm-4 rounded btn-primary text-center" href="{{route('admin.reset_password')}}">{{__('text.word_proceed')}}</a>
                    </div>
                @else
                    @yield('section')
                @endif
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
<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{asset('assets/js/ace.min.js')}}"></script>
<script src="{{ asset('libs')}}/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
<script src="{{ asset('tel_input_build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('tel_input_build/js/intlTelInput-jquery.min.js') }}"></script>
<script>
    $(function () {
        $('.table , .adv-table table').DataTable({
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
            info:     false,
            searching: true,
            // order: [
            //     [1, 'asc']
            // ],
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
</body>
</html>