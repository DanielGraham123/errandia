<style>
    .navbar-nav li:hover > ul.dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu > li > a:hover:after {
        text-decoration: underline;
        transform: rotate(-90deg);
    }
</style>
<div class="helep_btn_raise container-fluid">
    <header class="container-fluid">
        <nav class="helep-color navbar navbar-expand-lg navbar-light rounded row">
            <div class="col-md-1">
                <div class="d-flex">
                    <a href="{{url('/')}}">
                        <img class="footer-logo" src="{{asset('images/logo-1.png')}}">
                    </a>
                </div>
                <div class="d-flex pl-3 mt-n5 float-right">
                    <ul class="d-flex d-lg-none">
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="{{get_user_account_link()}}" style="margin-top: -5px;">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                    </ul>

                    <button onclick="showCategoryList()" class="navbar-toggler"
                            style="height: 1.7em !important; margin-top: 10px;background: #FFFFFF !important;font-size: 12px !important;padding:-5px"
                            type="button"
                            aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon" style="font-size: 10px"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <form class="" method="GET" action="{{route('productsearch')}}">
                    <div class="input-group text-center">
                        <input name="search" type="text" class="form-control helep-input"
                               placeholder="@lang('general.search_bar_title_input_msg')" required/>
                        <div class="rounded-lg">
                            <button type="submit" class="btn-lg helep_btn_white_raise" style="">
                                <i class="fa fa-search"></i>&nbsp;@lang('general.search_bar_title_msg')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="collapse col-md-4 navbar-collapse" id="headerMenu">
                <ul class="navbar-nav">
                    <li class="nav-item pl-1  dropdown show d-none d-lg-block pl-1">
                        <a class="nav-link  dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"
                           href="#">@lang('general.search_bar_title_shops') </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($Regions as $region)
                                <a class="dropdown-item"
                                   href="{{route('regions_stores',['id' => $region->id])}}">{{ $region->name }}</a>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item show d-lg-none pl-1">
                        <a class="nav-link text-white" href="#">@lang('general.search_bar_title_shops') </a>
                        <ul>
                            @foreach ($Regions as $region)
                                <a class="nav-link text-white font-weight-bold pl-2"
                                   href="{{route('regions_stores',['id' => $region->id])}}">{{ $region->name }}</a>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item pl-1">
                        @if(auth()->check())
                            <a class="nav-link text-white pl-1" data-target="customSearchModal"
                               onclick="showCustomSearchModal(this,'customSearchModal')">@lang('general.send_custom_quote_msg')</a>
                        @else
                            <a class="nav-link text-white pl-1"
                               href="{{route('login_page', ['redirectTo' =>route('run_errand_page')])}}">@lang('general.send_custom_quote_msg')</a>
                        @endif
                    </li>

                    <li class="nav-item dropdown show d-none d-lg-block pl-1">
                        @if(auth()->check())
                            <a role="button"
                               class="nav-link dropdown-toggle text-white pl-1" aria-expanded="false"
                               aria-haspopup="true" href="{{get_user_account_link()}}" id="auth">
                                <i class="fa fa-user pr-1"></i>@lang('general.header_account_title')
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                            </ul>
                        @else
                            <a role="button"
                               class="nav-link dropdown-toggle text-white pl-1" aria-expanded="false"
                               aria-haspopup="true" href="{{route('login_page')}}" id="auth">
                                <i class="fa fa-user-circle pr-1"></i>@lang('general.login_title_msg')
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>

        {{--        @if(!$categories->isEmpty())--}}
        {{--            <div id="categoryList" class="helep-navbar-primary helep-animate-dropdown">--}}
        {{--                <div class="container align-items-center">--}}
        {{--                    <ul id="menu-navbar-primary" class="ml-lg-5 pl-lg-5 nav cat-navbar-nav navbar-nav yamm">--}}
        {{--                        @foreach($categories->take(6) as $category)--}}
        {{--                            <li id="" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat"><a--}}
        {{--                                    title=""--}}
        {{--                                    href="{{route('show_cat_products',['category'=>$category->slug])}}">{{$category->name}}</a>--}}
        {{--                            </li>--}}
        {{--                        @endforeach--}}
        {{--                    </ul>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </header>
</div>

<style>

    .helep-category-header {
        box-shadow: 0 2px 4px rgb(0 0 0 / 8%), 0 4px 12px rgb(0 0 0 / 8%);
        width: 100vw;
        position: relative;
        margin-left: calc(-50vw + 50% - 8px);
        background: #fff !important;
        border-top: 1px solid #ece8e8;
    }

    .helep-bar-nav {
        flex-direction: row !important;
    }

    .helep-navbar-primary {
        width: 100vw;
        position: relative;
        margin-left: calc(-50vw + 50% - 8px);
        background: #fff !important;
        border-top: 1px solid #ece8e8;
    }

    @media (max-width: 991.98px) {
        .helep-navbar-primary {
            margin-left: calc(-50vw + 50%)
        }
    }

    .helep-navbar-primary .nav {
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        position: relative
    }

    .helep-navbar-primary .nav .dropdown-menu li:not(.nav-title) a {
        font-size: 13.4px
    }

    .helep-navbar-primary .nav .dropdown > .dropdown-menu .dropdown-submenu {
        position: relative
    }

    .helep-navbar-primary .nav .dropdown > .dropdown-menu .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%
    }

    .helep-navbar-primary .nav .dropdown > .dropdown-menu .dropdown-submenu.menu-item-has-children > a:focus, .helep-navbar-primary .nav .dropdown > .dropdown-menu .dropdown-submenu.menu-item-has-children > a:hover {
        color: #212529
    }

    .helep-navbar-primary .nav .dropdown > .dropdown-menu .dropdown-submenu.menu-item-has-children > a::after {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        font-weight: 400;
        line-height: 1;
        vertical-align: -.125em;
        content: "";
        float: right;
        color: #656565;
        font-size: 10px
    }

    .helep-navbar-primary .nav .yamm-fw > .dropdown-menu, .helep-navbar-primary .nav .yamm-hw > .dropdown-menu, .helep-navbar-primary .nav .yamm-tfw > .dropdown-menu {
        overflow: hidden
    }

    .helep-navbar-primary .nav > .menu-item > .dropdown-menu {
        margin-top: 0
    }

    .helep-navbar-primary .nav > .menu-item > a {
        display: block;
        color: #113d6b !important;
        font-size: 14px;
        font-weight: 500;
        padding: .786em 0.5em;
    }

    .helep-navbar-primary .nav > .menu-item + .menu-item > a {
        border-left: 1px solid transparent
    }

    .helep-navbar-primary .nav > .menu-item.menu-item-has-children > a:after {
        border-top: none;
        border-left: none;
        border-right: none;
        width: auto;
        height: auto;
        font-size: .786em;
        line-height: 1;
        content: "\79";
        margin-left: 5px;
        margin-top: 1px
    }

    .helep-navbar-primary .nav > .menu-item.menu-item-has-children .dropdown-menu {
        border-top-width: 2px;
        border-top-style: solid
    }

    .helep-navbar-primary .yamm .nav-title a:focus, .helep-navbar-primary .yamm .nav-title a:hover {
        text-decoration: underline;
        font-weight: 700
    }

    .helep-navbar-primary .yamm .yamm-content {
        padding: 14px 26px 21px
    }

    .helep-navbar-primary .yamm .yamm-content li:not(.nav-title) a {
        line-height: 1.2;
        font-size: 13.4px
    }

    .helep-navbar-primary .yamm .yamm-content ul {
        margin-bottom: 10px
    }

    .helep-navbar-primary .yamm .yamm-fw .dropdown-menu {
        width: 100%
    }

    .cat-navbar-nav {
        flex-direction: row !important;
    }

    a {
        font-size: 15px !important;
    }

    .br-widget a {
        font-size: 35px !important;
    }

    .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }

    dl, ol, ul {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .nav-item:hover {
        background-color: #fff !important;
        color: #113d6b !important;
        border-radius: 1em !important;
    }
</style>

