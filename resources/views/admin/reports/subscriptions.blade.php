@extends('admin.layout')
@section('section')
    <div class="py-2">
        <form method="get">
            <div class="input-group imput-group-merge">
                <span class="input-group-addon" style="width: 7rem;">Month</span>
                <input class="form-control" name="month" type="month">
            </div>
        </form>
        <div class="d-flex justify-content-start flex-wrap">

            <div class="dashboard-item">
                    <div class="text-h6 text-capitalize">total subscriptions</div>
                    <div class="stats d-flex justify-content-between">
                        <span class="text-h5 d-block">46</span>
                        <span class="act text-link d-block">XAF 600K</span>
                    </div>
                    <div class="">
                        <a href="#" class="act text-link">view </a>
                    </div>
            </div>
            <div class="dashboard-item">
                    <div class="text-h6 text-capitalize">expired subscriptions</div>
                    <div class="stats d-flex justify-content-between">
                        <span class="text-h5 d-block">05</span>
                    </div>
                    <div class="">
                        <a href="#" class="act text-link">view </a>
                    </div>
            </div>
            <div class="dashboard-item">
                    <div class="text-h6 text-capitalize">total renewals</div>
                    <div class="stats d-flex justify-content-between">
                        <span class="text-h5 d-block">110</span>
                    </div>
                    <div class="">
                        <a href="#" class="act text-link">view </a>
                    </div>
            </div>
            <div class="dashboard-item">
                    <div class="text-h6 text-capitalize">cancelled subscriptions</div>
                    <div class="stats d-flex justify-content-between">
                        <span class="text-h5 d-block">16</span>
                        <span class="act text-link d-block">XAF 600K</span>
                    </div>
                    <div class="">
                        <a href="#" class="act text-link">view </a>
                    </div>
            </div>
            <div class="dashboard-item">
                    <div class="text-h6 text-capitalize">refunds</div>
                    <div class="stats d-flex justify-content-between">
                        <span class="text-h5 d-block">02</span>
                    </div>
                    <div class="">
                        <a href="#" class="act text-link"> </a>
                    </div>
            </div>

        </div>
        <div class="py-1 px-2">
            <div class="text-h6"> All Subscriptions</div>
            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>business</th>
                    <th>user</th>
                    <th>subscription plan</th>
                    <th>amount</th>
                    <th>expiry date</th>
                    <th>action</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach ($subscriptions as $sub)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>{{ $sub->business->name??'' }}</td>
                            <td>business user</td>
                            <td>plan</td>
                            <td>{{ $sub->plan->amount }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($sub->end_date)->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon fa fa-caret-down icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-light">
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.show', 'business') }}" class="text-decoration-none text-secondary">Reniew Subscription</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">View User Profile</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">View Business Profile</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary" onclick="_prompt('url', 'Are you sure you intend to delete this item? This process cannot be undone.')">Cancel Subscription</a></li>
                                    </ul>
                                </div>
                             </td>
                            <td><span class="label label-sm label-info arrowed arrowed-righ">Active</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection