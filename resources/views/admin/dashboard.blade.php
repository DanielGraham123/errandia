@extends('admin.layout')
@section('section')
@php

@endphp
<div>
    <div class="row">

       <div class=" col-md-3">
           <div class="dashboard-item">
               <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-users.svg') }}"></div>
               <span class="title">Users</span>
               <div class="stats">
                   <span class="qty text-extra">{{ $no_users }}</span>
                   <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
               </div>
           </div>
       </div>

       <div class=" col-md-3">
            <div class="dashboard-item">
                <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-businesses.svg') }}"></div>
                <span class="title">Businesses</span>
                <div class="stats">
                    <span class="qty text-extra">{{ $no_businesses }}</span>
                    <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
                </div>
            </div>
       </div>

        <div class="col-md-3">
            <div class="dashboard-item">
                <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-errands.svg') }}"></div>
                <span class="title">Errands</span>
                <div class="stats">
                    <span class="qty text-extra">{{ $no_errands }}</span>
                    <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
                </div>
            </div>
        </div>

       <div class="col-md-3">
            <div class="dashboard-item">
                <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-individuals.svg') }}"></div>
                <span class="title">Categories</span>
                <div class="stats">
                    <span class="qty text-extra">{{ $no_categories }}</span>
                    <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
                </div>
            </div>
       </div>

       <div class="col-md-3">
            <div class="dashboard-item">
                <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-admins.svg') }}"></div>
                <span class="title">Products</span>
                <div class="stats">
                    <span class="qty text-extra">{{ $no_products }}</span>
                    <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
                </div>
            </div>
       </div>

       <div class="col-md-3">
            <div class="dashboard-item">
                <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-services.svg') }}"></div>
                <span class="title">Services</span>
                <div class="stats">
                    <span class="qty text-extra">{{ $no_services }}</span>
                    <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
                </div>
            </div>
       </div>

       <div class="col-md-3">
            <div class="dashboard-item">
                <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-review.svg') }}"></div>
                <span class="title">Regions</span>
                <div class="stats">
                    <span class="qty text-extra">{{ $no_regions }}</span>
                    <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
                </div>
            </div>
       </div>

       <div class="col-md-3">
           <div class="dashboard-item">
               <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-towns.svg') }}"></div>
               <span class="title">Towns</span>
               <div class="stats">
                   <span class="qty text-extra">{{ $no_towns }}</span>
                   <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
               </div>
           </div>
       </div>

    </div>
</div>
@endsection
@section('script')

@endsection
