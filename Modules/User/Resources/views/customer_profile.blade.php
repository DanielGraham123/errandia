@extends('helep.buyer.layout.master')
@section('page_title') @lang('vendor.profile_page_title') @endsection
@section('title') @lang('vendor.profile_page_title') @endsection
@section('content')
    <div class="container py-2">
        @php
            $default_shop_avatar = md5(strtolower(trim($user->email)));
             $image_url ="https://www.gravatar.com/avatar/".$default_shop_avatar;
        @endphp
        {{-- Customer Details--}}
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2 pb-2">
                    <div class="ms-hero-bg-primary ms-hero-img-coffee">

                        <div class="color-medium index-1 text-center np-m pt-2">{{ $user->email }}</div>
                        <img src="{{$image_url}}" alt="..."
                             class="img-avatar-circle mt-n4">
                    </div>
                    <div class=" pt-4 text-center">
                        <h3 class="text-black-50 index-1 font-weight-bold text-center no-m pt-1">{{$user->name}}</h3>
                        <h4 class="color-black">{{$user->tel}}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Update customer profile info--}}
        @include('user::layouts.update_customer_profile',['profile'=>$profile,'selectedCategories'=>$selectedCategories])
        {{--Update sop owner personal info--}}
        @include('user::layouts.change_password',['user'=>$user])
        {{-- Change user password--}}
        <div class="row">
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#profile").addClass('active');
        });
    </script>
@endsection
