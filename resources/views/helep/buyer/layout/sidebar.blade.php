<div id="sidenav" class="vendor-sidenav">
    <div class="helep-color rounded  d-flex justify-content-center align-items-center mb-lg-5">
        <a href="{{url('/')}}" target="_blank">
            <img alt="Errandia Logo" src="{{asset('images/logo-1.png')}}" height="50px" class=" my-2"/>
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
                <li class="" id="buyer_sidebar_manage_errands">
                    <a href="{{route('customer_errands')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_errandia_history_msg')}}</span>
                    </a>
                </li>
                <li id="buyer_sidebar_manage_enquiry">
                    <a href="{{route("customer_enquiries")}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_enquiry_history_msg')}}</span>
                    </a>
                </li>
                <li id="buyer_sidebar_manage_product_reviews">
                    <a href="{{route('customer_reviews')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_reviews_history_msg')}}</span>
                    </a>
                </li>
                <li id="buyer_sidebar_manage_shop_subscribe">
                    <a href="{{route('customer_shop_subscriptions')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_shops_subscribe_msg')}}</span>
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
            <br/></div>
        <div class="d-flex-column mt-lg-5 align-items-center mb-lg-5">
            <ul class="navbar-link">
                <li class="" id="buyer_sidebar_manage_errands">
                    <a href="{{route('customer_errands')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_errandia_history_msg')}}</span>
                    </a>
                </li>
                <li id="buyer_sidebar_manage_enquiry">
                    <a href="{{route("customer_enquiries")}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_enquiry_history_msg')}}</span>
                    </a>
                </li>
                <li id="buyer_sidebar_manage_product_reviews">
                    <a href="{{route('customer_reviews')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_reviews_history_msg')}}</span>
                    </a>
                </li>
                <li id="buyer_sidebar_manage_shop_subscribe">
                    <a href="{{route('customer_shop_subscriptions')}}" class="mx-2  d-flex flex-nowrap">
                        <span>{{trans('buyer.buyer_sidebar_shops_subscribe_msg')}}</span>
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
