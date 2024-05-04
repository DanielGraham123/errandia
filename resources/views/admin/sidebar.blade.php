<?php require_once app_path('Http/helpers.php');?>
<?php $currentRouteName = Route::currentRouteName(); ?>

<aside id="sidebar" class="sidebar" >
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts" >
            <a href="{{route('admin.home')}}" class=""
            >{{ config('app.short_name') . ' Admin' }}</a>
    </div><!-- /.sidebar-shortcuts -->
    <ul class="nav nav-list">
        <li class="{{ $currentRouteName === 'admin.home' ? 'active' : '' }}">
            <a href="{{route('admin.home')}}">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-dashboard.svg') }}"></span>
                <span class="menu-text text-capitalize">Dashboard</span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="{{ $currentRouteName === 'admin.errands.index' ? 'active' : '' }}">
            <a
                href="{{route('admin.errands.index')}}">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-errands.svg') }}"></span>
                <span class="menu-text text-capitalize">Errands</span>
            </a>
            <b class="arrow"></b>
        </li>

        <li class="{{ $currentRouteName === 'admin.locations.towns' ? 'active' : '' }}">
            <a href="{{ route('admin.locations.towns') }}" class="text-capitalize">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-business-locations.svg') }}"></span>
                <span class="menu-text">Locations</span>
            </a>
        </li>


        <li class="has-sub {{ isRoutePrefixActive('admin.businesses') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="text-capitalize" data-toggle="collapse" data-target="#businessList" aria-expanded="false">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-businesses.svg') }}"></span>
                <span class="menu-text">Businesses</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <ul class="collapse sub-menu" id="businessList">
                <li>
                    <a href="{{ route('admin.businesses.create') }}" class="text-capitalize">
                        Add New
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.businesses.index') }}" class="text-capitalize">
                        All Businesses
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ $currentRouteName === 'admin.products.index' ? 'active' : '' }}">
            <a
                href="{{route('admin.products.index')}}">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-products.svg') }}"></span>
                <span class="menu-text text-capitalize">Products</span>
            </a>
        </li>

        <li class="{{ $currentRouteName === 'admin.services.index' ? 'active' : '' }}">
            <a
                href="{{route('admin.services.index')}}">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-services.svg') }}"></span>
                <span class="menu-text text-capitalize">Services</span>
            </a>
        </li>


        <li class="has-sub {{ isRoutePrefixActive('admin.categories') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="text-capitalize" data-toggle="collapse" data-target="#categoriesList">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-dashboard.svg') }}"></span>
                <span class="menu-text">Categories</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <ul id="categoriesList" class="collapse sub-menu">
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="text-capitalize">
                        All Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.sub_categories') }}" class="text-capitalize">
                        Sub-Categories
                    </a>
                </li>
            </ul>
        </li>

        <?php
        //                <li>
        //                    <a
        //                        href="{{route('admin.reviews.index')}}">
        //                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-dashboard-review.svg') }}"></span>
        //                        <span class="menu-text text-capitalize">Manage Reviews</span>
        //                    </a>
        //                    <b class="arrow"></b>
        //                </li>
        ?>


        <li class="has-sub {{ isRoutePrefixActive('admin.users') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="text-capitalize" data-toggle="collapse" data-target="#usersList" aria-expanded="false">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-manage-users.svg') }}"></span>
                <span class="menu-text">Users</span>
            </a>

            <ul id="usersList" class="collapse sub-menu">
                <?php
                //                             <li>
                //                            <a href="{{route('admin.users.index')}}?type=admin" class="text-capitalize">
                //                                <i class="menu-icon fa fa-caret-right"></i>
                //                                {{trans_choice('text.add_admin', 2)}}
                //                            </a>
                //                            <b class="arrow"></b>
                //                        </li>
//                <li>
//                    <a href="{{route('admin.roles.index')}}" class="text-capitalize">
//                        {{trans_choice('text.role', 2)}}
//                    </a>
//                </li>
                ?>
                <li  class="{{ $currentRouteName === 'admin.users.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.users.create') }}" class="text-capitalize">
                        Add New User
                    </a>
                </li>

                <li class="{{ $currentRouteName === 'admin.users.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="text-capitalize">
                        All Users
                    </a>
                </li>
            </ul>
        </li>
        {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
        @endif --}}

        <?php
//        <li>
//            <a href="#" class="dropdown-toggle text-capitalize">
//                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
//                        src="{{ asset('assets/admin/icons/icon-manage-admins.svg') }}"></span>
//                <span class="menu-text">Manage Admins</span>
//                <b class="arrow fa fa-angle-down"></b>
//            </a>
//
//            <ul class="submenu">
//                <li>
//                    <a href="{{ route('admin.admins.index') }}" class="text-capitalize">
//                        <i class="menu-icon fa fa-caret-right"></i>
//                        All Admins
//                    </a>
//                    <b class="arrow"></b>
//                </li>


                //                        <li>
                //                            <a href="{{ route('admin.admins.roles') }}" class="text-capitalize">
                //                                <i class="menu-icon fa fa-caret-right"></i>
                //                                Manage Roles
                //                            </a>
                //                            <b class="arrow"></b>
                //                        </li>


//            </ul>
//        </li>
         ?>
        {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
        @endif --}}


        <li class="{{ $currentRouteName === 'admin.plans.index' ? 'active' : '' }}">
            <a
                href="{{route('admin.plans.index')}}">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-subscription-plans.svg') }}"></span>
                <span class="menu-text text-capitalize">Subscription Plans</span>
            </a>
        </li>

        <?php
        //                  <li>
        //                    <a
        //                        href="{{route('admin.sms_bundles.index')}}">
        //                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-sms-bundles.svg') }}"></span>
        //                        <span class="menu-text text-capitalize">SMS Bundles</span>
        //                    </a>
        //                    <b class="arrow"></b>
        //                </li>
        ?>

        <li class="has-sub {{ isRoutePrefixActive('admin.reports') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="text-capitalize" data-toggle="collapse" data-target="#reports" aria-expanded="false">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-reports.svg') }}"></span>
                <span class="menu-text">Reports</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <ul id="reports" class="collapse sub-menu">
                <li class="{{ $currentRouteName === 'admin.reports.subscription' ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.subscription') }}" class="text-capitalize">
                        Subscriptions
                    </a>
                </li>

                <?php
                //                         <li>
                //                            <a href="{{ route('admin.reports.sms') }}" class="text-capitalize">
                //                                <i class="menu-icon fa fa-caret-right"></i>
                //                                SMS
                //                            </a>
                //                            <b class="arrow"></b>
                //                        </li>
                ?>

            </ul>
        </li>
        {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
        @endif --}}

        <?php
        //                <li>
        //                    <a href="#" class="dropdown-toggle text-capitalize">
        //                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-settings.svg') }}"></span>
        //                        <span class="menu-text">Settings</span>
        //                        <b class="arrow fa fa-angle-down"></b>
        //                    </a>
        //
        //                    <ul class="submenu">
        //                        <li>
        //                            <a href="{{ route('admin.settings.profile') }}" class="text-capitalize">
        //                                <i class="menu-icon fa fa-caret-right"></i>
        //                                My Profile
        //                            </a>
        //                            <b class="arrow"></b>
        //                        </li>
        //
        //                        <li>
        //                            <a href="{{ route('admin.settings.footer') }}" class="text-capitalize">
        //                                <i class="menu-icon fa fa-caret-right"></i>
        //                                Manage Footer
        //                            </a>
        //                            <b class="arrow"></b>
        //                        </li>
        //
        //                        <li>
        //                            <a href="{{ route('admin.settings.change_password') }}" class="text-capitalize">
        //                                <i class="menu-icon fa fa-caret-right"></i>
        //                            Change Password
        //                            </a>
        //                            <b class="arrow"></b>
        //                        </li>
        //
        //                    </ul>
        //                </li>
        ?>
        {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
        @endif --}}

        <li class="has-sub {{ isRoutePrefixActive('admin.pages') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="text-capitalize" data-toggle="collapse" data-target="#pagesList" aria-expanded="false">
                <span style="height: 2rem; width: 2rem;" class="menu-icon"><img
                        src="{{ asset('assets/admin/icons/icon-manage-pages.svg') }}"></span>
                <span class="menu-text">Manage Pages</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <ul id="pagesList" class="collapse sub-menu">
                <?php
                //                        <li>
                //                            <a href="{{ route('admin.pages.index') }}" class="text-capitalize">
                //                                <i class="menu-icon fa fa-caret-right"></i>
                //                                All Pages
                //                            </a>
                //                            <b class="arrow"></b>
                //                        </li>
                ?>
                <li class="{{ $currentRouteName === 'admin.pages.privacy' ? 'active' : '' }}">
                    <a href="{{ route('admin.pages.privacy') }}" class="text-capitalize">
                        Privacy Policies
                    </a>
                    <b class="arrow"></b>
                </li>

                <?php
                //                        <li>
                //                            <a href="{{ route('admin.pages.team_members') }}" class="text-capitalize">
                //                                <i class="menu-icon fa fa-caret-right"></i>
                //                                Team Members
                //                            </a>
                //                            <b class="arrow"></b>
                //                        </li>
                ?>
            </ul>
        </li>
        {{-- @if (\auth('admin')->user()->hasPermissionTo('manage_user'))
        @endif --}}

        <?php
        //                <li>
        //                    <a href="{{route('admin.abuse.reports')}}">
        //                        <span style="height: 2rem; width: 2rem;" class="menu-icon"><img src="{{ asset('assets/admin/icons/icon-business-locations.svg') }}"></span>
        //                        <span class="menu-text text-capitalize">Abuse Reports</span>
        //                    </a>
        //                    <b class="arrow"></b>
        //                </li>
        ?>
    </ul>


<!--    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">-->
<!--        <i id="sidebar-toggle-icon" class="ace-icon f ace-save-state"></i>-->
<!--    </div>-->
</aside>