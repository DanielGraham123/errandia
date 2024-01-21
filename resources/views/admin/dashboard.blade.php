@extends('admin.layout')
@section('section')
@php

@endphp
<div>
    <div class="d-flex justify-content-start flex-wrap">

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-users.svg') }}"></div>
            <span class="title">Users</span>
            <div class="stats">
                <span class="qty text-extra">46</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-businesses.svg') }}"></div>
            <span class="title">Businesses</span>
            <div class="stats">
                <span class="qty text-extra">22</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-service-provider.svg') }}"></div>
            <span class="title">Service Providers</span>
            <div class="stats">
                <span class="qty text-extra">10</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-individuals.svg') }}"></div>
            <span class="title">Individuals</span>
            <div class="stats">
                <span class="qty text-extra">12</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-admins.svg') }}"></div>
            <span class="title">Admins</span>
            <div class="stats">
                <span class="qty text-extra">4</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-errands.svg') }}"></div>
            <span class="title">Errands</span>
            <div class="stats">
                <span class="qty text-extra">55</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-products.svg') }}"></div>
            <span class="title">Products</span>
            <div class="stats">
                <span class="qty text-extra">100</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-services.svg') }}"></div>
            <span class="title">Services</span>
            <div class="stats">
                <span class="qty text-extra">35</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-review.svg') }}"></div>
            <span class="title">Reviews and Ratings</span>
            <div class="stats">
                <span class="qty text-extra">32</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-subscription-plans.svg') }}"></div>
            <span class="title">Subscription Plans</span>
            <div class="stats">
                <span class="qty text-extra">05</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-sms.svg') }}"></div>
            <span class="title">SMS Bundles</span>
            <div class="stats">
                <span class="qty text-extra">04</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-towns.svg') }}"></div>
            <span class="title">Towns</span>
            <div class="stats">
                <span class="qty text-extra">10</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-street.svg') }}"></div>
            <span class="title">Streets</span>
            <div class="stats">
                <span class="qty text-extra">25</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-promo-featured-business.svg') }}"></div>
            <span class="title">Featured Businesses</span>
            <div class="stats">
                <span class="qty text-extra">5</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

    </div>
</div>
@endsection
@section('script')

@endsection
