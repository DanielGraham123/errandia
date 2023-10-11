@extends('admin.layout')
@section('section')
@php

@endphp
<div>
    <div class="text-h5 my-3">Rubiliams Hair Clinic</div>
    <div class="d-flex justify-content-start flex-wrap">

       <div class="dashboard-item">
            <span class="title">Products</span>
            <div class="stats">
                <span class="qty text-extra">46</span>
                <span><a class="act text-link">view <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <span class="title">Services</span>
            <div class="stats">
                <span class="qty text-extra">22</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <span class="title">Shop Views</span>
            <div class="stats">
                <span class="qty text-extra">10</span>
            </div>
       </div>

       <div class="dashboard-item">
            <span class="title">Review</span>
            <div class="stats">
                <span class="qty text-extra">10</span>
                <span><a class="act text-link">view <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <span class="title">Errands</span>
            <div class="stats">
                <span class="qty text-extra">10</span>
                <span><a class="act text-link">view <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>


    </div>
    <div class="mx-3 rounded py-4 px-2">
        <span class="text-uppercase h6 my-3 d-block">Business details</span>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Business name  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic <label class="label label-in label-primary">Head Office</label></span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Ratings  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Verification status  </span><span class="text-secondary text-capitalize fa fa"><span class="fa fa-certificate fa-2x text-primary"></span> Verified</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Categories  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Website  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Phone  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Email  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Location  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Created On  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Business Category  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 d-flex text-capitalize">
            <a hred="#" class="button-primary text-white"><span class="fa fa-edit icon"></span>edit business</a>
            <a hred="#" class="btn btn-md btn-danger mx-3"><span class="fa fa-block icon"></span>suspend</a>
        </div>
    </div>
    <div class="row">
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 ">Staff</div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-info arrowed-in">Branch Location</span>
                    </div>
                </div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-info arrowed-in">Branch Location</span>
                    </div>
                </div>
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Add Staff</a>
                </div>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 ">Branches <span class="text-primary">02</span></div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-light arrowed-in">Products: <span class="text-dark">12</span> Services<span class="text-dark">02</span></span>
                    </div>
                </div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-light arrowed-in">Products: <span class="text-dark">12</span> Services<span class="text-dark">02</span></span>
                    </div>
                </div>
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Add Branch</a>
                </div>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-3 shadow px-5" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 d-flex justify-content-around">
                    <span>Subscription</span> <span class="text-extra">Expiry Date: <span class="text-danger">{{ now() }}</span></span>
                </div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Plan  </span><span class="text-secondary text-capitalize">Yearly, XAF 234652</span>
                </div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Subscription status  </span>
                    <span class="text-secondary text-capitalize"><span class="label label-sm label-info arrowed-in">Active</span></span>
                </div>
                
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Update Subscription Status</a>
                </div>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-5 shadow" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 ">SMS Plan</div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Plan  </span><span class="text-secondary text-capitalize">Yearly, XAF 234652</span>
                </div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Status  </span>
                    <span class="text-secondary text-capitalize"><span class="label label-sm label-info arrowed-in">Active</span></span>
                </div>
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Update SMS Plan</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')

@endsection
