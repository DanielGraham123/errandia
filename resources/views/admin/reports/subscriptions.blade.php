@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-start flex-wrap">

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-users.svg') }}"></div>
            <span class="title">Users</span>
            <div class="stats">
                <span class="qty text-extra">46</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

       <div class="dashboard-item">
            <div class="icon-box"><img src="{{ asset('assets/admin/icons/icon-dashboard-businesses.svg') }}"></div>
            <span class="title">Businesses</span>
            <div class="stats">
                <span class="qty text-extra">22</span>
                <span><a class="act text-link">manage <img style="height: 1.5rem; width: 1.5rem;" src="{{asset('assets/admin/icons/icon-arrow-right.svg')}}"></a></span>
            </div>
       </div>

    </div>
        <div class="py-1 px-2 d-flex">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>business</th>
                    <th>user</th>
                    <th>subscription plan</th>
                    <th>amount</th>
                    <th>expiry date</th>
                    <th>status</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach ($subscriptions as $sub)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>{{ $sub->business->name??'' }}</td>
                            <td>{{  }}</td>
                            <td>{{  }}</td>
                            <td>{{ $sub->plan->amount }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($sub->end_date)->format('d M Y') }}</td>
                            <td><span class="label label-sm label-info arrowed arrowed-righ">Active</span></td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon fa fa-caret-down icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-light">
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.show', 'business') }}" class="text-decoration-none text-secondary">Reniew Subscription</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">View User Profile</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">View Business Profile</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">Cancel Subscription</a></li>
                                    </ul>
                                </div>
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection