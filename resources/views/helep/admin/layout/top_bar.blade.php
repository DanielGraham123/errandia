<header class="bg-white helep_round">
    <nav class="mx-5 navbar navbar-expand-lg navbar-light rounded bg-white">
        <ul class="ml-auto d-flex flex-nowrap align-items-center">
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{route('user_profile')}}">
                    <i class="fa fa-user helep-text-color"></i>
                    <span
                        class="d-sm-inline-flex helep-text-color font-weight-bolder mx-3">{{explode(' ',$profile->name)[0]}}</span>
                </a>
            </li>
        </ul>
    </nav>
</header>
