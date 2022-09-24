<div id="sidenav" class="vendor-sidenav">
    <div class="helep-color rounded d-flex justify-content-center align-items-center mb-lg-5">
        <a href="{{url('/')}}" target="_blank">
            <img alt="Errandia Logo" src="{{asset('images/logo-1.png')}}" height="50px" class="my-2"/>
        </a>
    </div>
    @if(isMobile())
        <div class="d-flex justify-content-start align-items-start my-3 mb-lg-5">
            <button onclick="showSideBarMenu()" class="navbar-toggler"
                    style="padding: 10px;height: 1.7em !important;background:#113d6b !important;font-size: 22px !important;">
                <span class="navbar-toggler-icon" style="font-size: 20px"><i
                        class="zmdi zmdi-menu text-white"></i></span>
            </button>
        </div>
        <div id="mobileSideBarMenu" class="d-flex-column mt-lg-5 align-items-center mb-lg-5 d-none">
            <ul class="navbar-link">
                <li class="" id="vendor_manage_product">
                    <a href="{{route('products')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_products_msg')}}</span>
                    </a>
                </li>
                <li id="vendor_manage_orders">
                    <a href="{{route("shop_subscribers_list")}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_orders_msg')}}</span>
                    </a>
                </li>
                {{--            <li id="vendor_notification">--}}
                {{--                <a href="index.html" class="mx-2  d-flex flex-nowrap">--}}
                {{--                    <span>{{trans('vendor.sidebar_manage_notification_msg')}}</span>--}}
                {{--                </a>--}}
                {{--            </li>--}}
                <li id="vendor_sidebar_manage_product_quote">
                    <a href="{{route('product_quote_list')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_product_quote')}}</span>
                    </a>
                </li>
                <li id="vendor_sidebar_manage_product_enquiry">
                    <a href="{{route('product_enquiry_list')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_product_enquiry')}}</span>
                    </a>
                </li>
                <li id="vendor_sidebar_manage_product_review">
                    <a href="{{route('product_review_list')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_product_review')}}</span>
                    </a>
                </li>
                <li id="profile">
                    <a href="{{route('user_profile')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_setting_msg')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('logout')}}" class="mx-2  text-danger d-flex flex-nowrap">
                        <span>{{trans('general.logout_link')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    @else
        <div class="clearfix">
            <hr/>
            </div>
        <div class="d-flex-column mt-lg-5 align-items-center mb-lg-5">
            <ul class="navbar-link">

                <li class="" >
                    <a href="{{url('/')}}" target="_blank" class="mx-2 d-flex flex-nowrap">
                        Home
                    </a>
                </li>
                <li class="" id="vendor_manage_product">
                    <a href="{{route('products')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_products_msg')}}</span>
                    </a>
                </li>

                <li id="vendor_manage_orders">
                    <a href="{{route("shop_subscribers_list")}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_orders_msg')}}</span>
                    </a>
                </li>
                {{--            <li id="vendor_notification">--}}
                {{--                <a href="index.html" class="mx-2  d-flex flex-nowrap">--}}
                {{--                    <span>{{trans('vendor.sidebar_manage_notification_msg')}}</span>--}}
                {{--                </a>--}}
                {{--            </li>--}}
                <li id="vendor_sidebar_manage_product_quote">
                    <a href="{{route('product_quote_list')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_product_quote')}}</span>
                    </a>
                </li>
                <li id="vendor_sidebar_manage_product_enquiry">
                    <a href="{{route('product_enquiry_list')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_product_enquiry')}}</span>
                    </a>
                </li>
                <li id="vendor_sidebar_manage_product_review">
                    <a href="{{route('product_review_list')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_product_review')}}</span>
                    </a>
                </li>
                <li id="run_errand_page">
                    <a href="{{route('run_errand_page')}}" class="mx-2 d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_errand_page')}}</span>
                    </a>
                </li>
                <br/>
                <li id="profile">
                    <a href="{{route('user_profile')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('vendor.sidebar_manage_setting_msg')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('logout')}}" class="mx-2  text-danger d-flex flex-nowrap">
                        <span>{{trans('general.logout_link')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif
</div>
<script>
    function showSideBarMenu() {
        $('#mobileSideBarMenu').toggleClass("d-block");
    }
</script>
