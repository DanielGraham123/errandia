@include('helep.general.header')

<div class="row p-lg-5 mr-lg-2">
    <div class="col-md-2 col-sm-12 d-none d-lg-block card helep_round" id="categoryList">
        @include('helep.general.menu_sidebar')
    </div>
    <div class="col-md-10 col-sm-12">
        <div id='pagecontent' class="pagecontent  flex-grow-1" style="background-color: rgb(245, 245, 245)">
            <div class="p-sm">
                <div class="py-5 p-1">
                    @if(session('success'))
                        <div class="alert alert-success helep_alert_round">{!! session('success') !!}</div>
                    @endif
                    @if(session('danger'))
                        <div class="alert alert-danger helep_alert_round">{!! session('danger') !!}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger helep_alert_round pl-5 ml-3 pr-5">
                            <ul class="text-black-50">
                                @foreach ($errors->all() as $error)
                                    <li class="text-black">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>

    </div>
</div>

<br/>
@include('helep.general.footer')
