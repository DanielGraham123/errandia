@extends('b_admin.layout')
@section('section')   

    <div class="dashboard-right-sidebar">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                aria-labelledby="pills-dashboard-tab">
                <a href="">
                <div class="dashboard-home">
                    <div class="title">
                        <h2>My Dashboard</h2>
                        <span class="title-leaf">
                            <svg class="icon-width bg-gray">
                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                        
                    </div>
                </a>

                    <div class="dashboard-user-name">
                        <h6 class="text-content">Hello, <b class="text-title">{{ auth()->user()->name??'' }}</b></h6>
                        <p class="text-content">Welcome to your Errandia Dashboard</p>
                    </div>

                    
                    <div class="row my-5">
                        @if (auth()->user()->shops->count() > 0)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                                <div class="rounded shadow bg-white card px-4 py-3">
                                    <div class="card-img-top">
                                        <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-create-shop.svg') }}">
                                    </div>
                                    <h5 class="card-title text-h6">Businesses</h5>
                                    <p class="card-text text-body" style="font-weight: 500;"> Create a business and start selling online</p>
                                    <a class="button-secondary my-3 mx-auto" href="{{ route('business_admin.businesses.index') }}">Businesses</a>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                            <div class="rounded shadow bg-white card px-4 py-3">
                                <div class="card-img-top">
                                    <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-errand.svg') }}">
                                </div>
                                <h5 class="card-title text-h6">Run Errand</h5>
                                <p class="card-text text-body" style="font-weight: 500;">Create a shop and start selling online</p>
                                <a class="button-secondary my-3 mx-auto" href="{{ route('business_admin.errands.create') }}">Run an errand</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                            <div class="rounded shadow bg-white card px-4 py-3">
                                <div class="card-img-top">
                                    <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-profile.svg') }}">
                                </div>
                                <h5 class="card-title text-h6">Complete Profile</h5>
                                <p class="card-text text-body" style="font-weight: 500;">Create a shop and start selling online</p>
                                <a class="button-secondary my-3 mx-auto" href="">Update Profile</a>
                                <span class="text-quote text-center d-block">Your profile is <span class="text-danger">20%</span> complete</span>
                            </div>
                        </div>
                        @if (auth()->user()->shops->count()  > 0)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                                <div class="rounded shadow bg-white card px-4 py-3">
                                    <div class="card-img-top">
                                        <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-products-2.svg') }}">
                                    </div>
                                    <h5 class="card-title text-h6">Manage Products</h5>
                                    <p class="card-text text-body" style="font-weight: 500;">Create a shop and start selling online</p>
                                    <a class="button-secondary my-3 mx-auto" href="">Manage Products</a>
                                </div>
                            </div>
                        @endif
            
            
                        {{-- IF USRE ALREADY HAS A SHOP --}}
                        <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                            <div class="rounded shadow bg-white card px-4 py-3">
                                <div class="card-img-top">
                                    <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-dashboard-errand.svg') }}">
                                </div>
                                <h5 class="card-title text-h6">Errands</h5>
                                <h5 class="card-title text-h6">02</h5>
                                <span class="d-block py-3 my-1"></span>
                                <a class="text-link my-3 mx-auto" href="">Manage Products</a>
                            </div>
                        </div>
                        @if (auth()->user()->shops->count()  > 0)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                                <div class="rounded shadow bg-white card px-4 py-3">
                                    <div class="card-img-top">
                                        <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-dashboard-businesses.svg') }}">
                                    </div>
                                    <h5 class="card-title text-h6">Shops</h5>
                                    <h5 class="card-title text-h6">02</h5>
                                    <span class="d-block py-3 my-1"></span>
                                    <a class="text-link my-3 mx-auto" href="">Manage Shops</a>
                                </div>
                            </div>
                        
                            <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                                <div class="rounded shadow bg-white card px-4 py-3">
                                    <div class="card-img-top">
                                        <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-dashboard-products-services.svg') }}">
                                    </div>
                                    <h5 class="card-title text-h6">Products & Services</h5>
                                    <span class="card-title"> products <span class="text-h6">02</span>  services <span class="text-h6">06</span></span>
                                    <span class="d-block py-3 my-1"></span>
                                    <a class="text-link my-3 mx-auto" href="">Manage Products</a>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-6 col-md-4 col-lg-3 p-2">
                            <div class="rounded shadow bg-white card px-4 py-3">
                                <div class="card-img-top">
                                    <img class="img-responsive mx-auto my-4" style="width: 6rem !important;" src="{{ asset('assets/badmin/icon-dashboard-businesses.svg') }}">
                                </div>
                                <h5 class="card-title text-h6">Enquiries</h5>
                                <h5 class="card-title text-h6">02 <span class="label label-success m-2 label-out label-sm px-2">1 new</span></h5>
                                <span class="d-block py-3 my-1"></span>
                                <a class="text-link my-3 mx-auto" href="">View Enquiries</a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('script')

@endsection
