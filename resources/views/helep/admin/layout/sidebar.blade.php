<div id="sidenav" class="admin-sidenav d-lg-block helep_round">
    <div class="d-flex justify-content-center align-items-center my-3">
        <img src="{{asset('images/logo-1.png')}}" height="30px" class=" my-2"/>
    </div>
    <div class="d-flex-column align-items-center mb-lg-5">
        <ul class="navbar-link">
            <li id="admin_dashboard">
                <a target="_blank" href="{{url('/')}}" class="mx-2 mx-md-5 d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_home_msg')}}</span>
                </a>
            </li>
            <li id="admin_manage_users">
                <a href="{{route('users')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_user_msg')}}</span>
                </a>
            </li>
            <li class="" id="admin_manage_category">
                <a href="{{route('categories')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_category')}}</span>
                </a>
            </li>
            <li class="" id="sidebar_manage_slider">
                <a href="{{route('slider')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_slider')}}</span>
                </a>
            </li>
            <li class="" id="sidebar_manage_street">
                <a href="{{route('street')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.street_list_msg')}}</span>
                </a>
            </li>
            <li class="" id="sidebar_manage_towns"
                @if(Request::is('regions/town', 'admin/all_courses')) style="background-color: #fff;" @endif>
                <a href="{{route('towns')}}" class="mx-2 mx-md-5  d-flex flex-nowrap"
                   @if (Request::is('regions/town')) style="color: #113d6b !important;" @endif>
                    <span>{{trans('admin.sidebar_manage_towns')}}</span>
                </a>
            </li>
            <li class="" id="admin_manage_shops">
                <a href="{{route('shop_list')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_shop')}}</span>
                </a>
            </li>
            <li id="admin_manage_admin">
                <a href="{{route('admin_list')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_admin')}}</span>
                </a>
            </li>
            {{--            <li id="admin_manage_notification">--}}
            {{--                <a href="notifications.html" class="mx-2 mx-md-5  d-flex flex-nowrap">--}}
            {{--                    <span>{{trans('admin.sidebar_manage_notifications')}}</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            <li id="admin_manage_subscription">
                <a href="{{route('subscription')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_subscriptions')}}</span>
                </a>
            </li>
            <li id="admin_manage_shop_subscription">
                <a href="{{route('shop-subscription')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_manage_shop_subscription')}}</span>
                </a>
            </li>
            <li id="admin_manage_site_page">
                <a href="{{route('manage_site_pages')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('admin.sidebar_site_page')}}</span>
                </a>
            </li>
            <li><br/></li>
            <li id="admin_manage_support">
                <a href="{{url('logout')}}" class="mx-2 mx-md-5  d-flex flex-nowrap">
                    <span>{{trans('general.logout_link')}}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
