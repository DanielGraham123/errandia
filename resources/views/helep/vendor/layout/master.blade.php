@include('helep.admin.layout.header')
@yield('style')
@include('helep.vendor.layout.sidebar')
<div id='pagecontent' class="pagecontent  flex-grow-1" style="background-color: rgb(245, 245, 245)">
    @include('helep.vendor.layout.top_bar')
    <div class="clearfix"><br/></div>
    <div class="bg-light-gray helep_round pb-5 pt-3 mt-3 ml-1 mr-1">
        <div class="">
            <h4 class=" ml-n5 text-black-50 p-2 text-center font-weight-bold">@yield('title')</h4>
            <div class=" p-1">
                @if(session('success'))
                    <div class="alert alert-success helep_alert_round">{!! session('success') !!}</div>
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
@include('helep.general.footer')
