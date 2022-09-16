@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.sidebar_manage_shop_subscriptions') @endsection
@section('title') @lang('admin.sidebar_manage_shop_subscriptions') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_shop_subscription')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>Select Shop To Active
                    </button>
                </a></div>
        </div>

            <table class="table table-striped table-bordered nowrap" style="width:100%" id="subscriptionTable">
                <thead>
                <tr>
                    <th>Shop Name</th>
                    <th>Package Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Expire in</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $subscription)
                    <?php
                    $suspendBtn = false;
                    if (strtotime($subscription->end_date) > strtotime(date("Y-m-d"))) {
                        $status = "Active";
                        //check if subscription is due
                        $todayDate = \Carbon\Carbon::now();
                        $subscriptionEndDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $subscription->end_date);
                        $todayDate->diffInDays($subscriptionEndDate);
                        $dueDays = $subscriptionEndDate->diffInDays($todayDate);
                        if ($dueDays <= 10) {
                            $status = "Due - " . $dueDays . " left";
                        }
                    } else {
                        $status = "Expired!";
                        $suspendBtn = true;
                    }
                    $expireDays = (strtotime($subscription->end_date) - strtotime(date("Y-m-d"))) / 86400;
                    $expireDays = $expireDays < 0 ? 0 : $expireDays;
                    ?>
                    
                    @if($status=="Active")
                    <tr>
                        <td>{{$subscription->ShopName}}</td>
                        <td>{!!$subscription->SubName!!}</td>
                        <td>{{date("Y-m-d",strtotime($subscription->start_date))}}</td>
                        <td>{{date("Y-m-d",strtotime($subscription->end_date))}}</td>
                        <td>{{$expireDays}} Days</td>
                        <td>
                            @if($status=='Expired!')
                                <span style="color:#CC6600; font-weight:bold;">{{$status}}</span>
                            @elseif($status=="Active")
                                <span style="color:#00CC00;font-weight:bold;">{{$status}}</span>
                            @else
                                <span style="color:yellow;font-weight:bold;">{{$status}}</span>
                            @endif
                        </td>
                        <td>
                            @if($status=="Active")
                                <a href="{{route('block_shop_profile',
                      ['shop_id'=>$subscription->shop_id,'subscriptionId'=>$subscription->shop_subscription_id])}}">
                                    <button type="button" class="btn helep_btn_raise">
                                        <i class="zmdi zmdi-undo" aria-hidden="true"></i>Cancel
                                    </button>
                                </a>
                            @endif
                            @if($suspendBtn && $subscription->shop->status ==0)
                                <span style="color:#CC6600; font-weight:bold;">Shop Profile Suspended</span>
                            @endif
                        </td>
                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>
    </div>
@endsection
@section("css")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection

@section('js')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_shop_subscription").addClass('active');
            $('#subscriptionTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection

