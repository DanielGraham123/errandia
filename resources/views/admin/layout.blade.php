<!DOCTYPE html>
<html lang="en">

@include('admin.head')
<body class="no-skin">
@include('admin.preloader')

<div class="wrapper">
    @include('admin.sidebar')

    <div class="page-wrapper">
        <header id="header" class="main-header ace-save-state ">
            <nav id="navbar" class="navbar navbar-static-top  ace-save-state navbar-expand-lg">
                <div class="navbar-container w-100 ace-save-state" id="navbar-container">
                    <div class="navbar-header pull-left border-right px-2">
                        <a class="navbar-brand">
                            <small class="text-body-sm"> <span
                                        class="hidden d-md-inline text-capitalize">visit errandia website</span>
                                <img src="{{ asset('assets/admin/icons/icon-external-link.svg') }}" class="w-auto"
                                     style="height: 1.3rem;" title="Visit Errandia Website">
                            </small>
                        </a>
                    </div>
                    <div class="navbar-header pull-left border-right px-2 d-md-inline">
                        <a class="navbar-brand" title="Add New">
                            <small class="text-body-sm">
                                <img src="{{ asset('assets/admin/icons/icon-add.svg') }}" class="w-auto"
                                     style="height: 1.3rem;">
                                {{-- <span class=" text-capitalize mx-2">add new</span>
                                <img src="{{ asset('assets/admin/icons/icon-dropdown.svg') }}" class="w-auto"
                                     style="height: 1.3rem;"> --}}
                            </small>
                        </a>
                    </div>


                    <div class="navbar-header pull-right border-right px-2">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="navbar-brand border-0 bg-white">
                                <small class="text-body-sm">
                                    <span class="hidden d-md-inline text-capitalize">Logout</span>
                                    <img src="{{ asset('assets/admin/icons/icon-logout.svg') }}" class="w-auto"
                                         style="height: 1.7rem;" title="Logout">
                                </small>
                            </button>
                        </form>
                    </div>
                    <div class="navbar-header pull-right border-right px-2">
                        <a class="navbar-brand">
                            <small class="text-body-sm">
                                <img src="{{ asset('assets/admin/images/admin-profile-pic.png') }}" class="w-auto"
                                     style="height: 2.2rem; border-radius: 50% !important;" title="Profile">
                                <span class="hidden d-md-inline text-capitalize">Johnson</span>
                            </small>
                        </a>
                    </div>
                    <div class="navbar-header pull-right border-right px-1">
                        <a class="navbar-brand">
                            <small class="text-body-sm">
                                <img src="{{ asset('assets/admin/icons/icon-notifications.svg') }}" class="w-auto"
                                     style="height: 2.2rem;" title="notifications">
                            </small>
                        </a>
                    </div>

                </div><!-- /.navbar-container -->
            </nav>
        </header>

        <div class="content-wrapper">
            <div class="content">

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
    </div>
</div>


<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>

@include('admin.scripts')
</body>
</html>