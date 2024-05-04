@extends('admin.layout')
@section('section')
@php

@endphp
<div>
    <div class="row">
        <x-dashboard-item
                :count="$no_users"
                icon="assets/admin/icons/icon-dashboard-users.svg"
                title="Users"
                route-name="admin.users.index" />

<!--        <div class=" col-md-3">-->
<!--            <div class="dashboard-item">-->
<!--                <div class="stats">-->
<!--                    <span class="qty text-extra">{{ $no_users }}</span>-->
<!--                    <div class="icon-box">-->
<!--                        <img src="{{ asset('assets/admin/icons/icon-dashboard-users.svg') }}">-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--               <div class="d-flex align-items-center justify-content-between bottom-stats mx-3">-->
<!--                   <span class="title">Users</span>-->
<!--                   <span>-->
<!--                        <a href="{{ route('admin.users.index') }}" class="act text-link">-->
<!--                            manage-->
<!--                            <img style="height: 1.5rem; width: 1.5rem;"-->
<!--                                 src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}">-->
<!--                        </a>-->
<!--                    </span>-->
<!--               </div>-->
<!--            </div>-->
<!--        </div>-->

        <x-dashboard-item
                :count="$no_businesses"
                icon="assets/admin/icons/icon-dashboard-businesses.svg"
                title="Businesses"
                route-name="admin.businesses.index" />

        <x-dashboard-item
                :count="$no_categories"
                icon="assets/admin/icons/icon-dashboard-individuals.svg"
                title="Categories"
                route-name="admin.categories.index" />


        <x-dashboard-item
                :count="$no_errands"
                icon="assets/admin/icons/icon-dashboard-errands.svg"
                title="Errands"
                route-name="admin.errands.index" />

<x-dashboard-item
                :count="$no_products"
                icon="assets/admin/icons/icon-dashboard-admins.svg"
                title="Products"
                route-name="admin.products.index" />

        <x-dashboard-item
                :count="$no_services"
                icon="assets/admin/icons/icon-dashboard-services.svg"
                title="Services"
                route-name="admin.services.index" />

        <x-dashboard-item
                :count="$no_regions"
                icon="assets/admin/icons/icon-dashboard-review.svg"
                title="Regions"
                route-name="admin.locations.towns" />

        <x-dashboard-item
                :count="$no_towns"
                icon="assets/admin/icons/icon-dashboard-towns.svg"
                title="Towns"
                route-name="admin.locations.towns" />


    </div>
</div>
@endsection
@section('script')

@endsection
