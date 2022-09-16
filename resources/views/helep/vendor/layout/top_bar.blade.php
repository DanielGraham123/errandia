<header class="helep-color helep_round">
    <nav class="mx-5 navbar navbar-expand-lg navbar-light rounded helep-color">
        <ul class="ml-auto d-flex flex-nowrap align-items-center">
            <li class="nav-item">
                <a class="nav-link helep-text-color" href="{{route('user_profile')}}">
                    <i class="fa fa-user text-white"></i>
                    <span
                        class="d-sm-inline-flex text-white font-weight-bolder mx-3">{{explode(' ',$profile->name)[0]}}</span>
                </a>
            </li>
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link  helep-text-color" href="messaging.html">--}}
            {{--                    <i class=" helep-text-color fa fa-envelope"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link" href="notification.html">--}}
            {{--                    <i class="helep-text-color fa fa-bell"></i>--}}
            {{--                    <span class='notification-dot'></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
    </nav>
</header>
