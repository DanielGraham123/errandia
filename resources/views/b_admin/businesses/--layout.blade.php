@extends('b_admin.layout')
@section('section')
    <div class="container my-0 py-3">
        <div class="row">
            {{-- side menu --}}
            <div class="col-md-3 col-lg-2 bg-white px-0 border-left border-right">
                <ul class="menu nav my-5 d-sm-flex d-md-block mx-0 px-0">
                    <li class="nav-item d-sm-inlineblock d-md-block border-bottom"><a class="nav-link" href="">Manage Businesses</a></li>
                    <li class="nav-item d-sm-inlineblock d-md-block border-bottom"><a class="nav-link" href="">Shop Managers</a></li>
                </ul>
            </div>
            <div class="col-md-9 col-lg-10">
                @yield('sub-section')
            </div>
        </div>
    </div>
@endsection