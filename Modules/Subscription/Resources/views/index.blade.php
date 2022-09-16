@extends('subscription::layouts.master')

@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.sidebar_manage_subscriptions') @endsection
@section('title') @lang('admin.sidebar_manage_subscriptions') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_subscription')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_subscriptions_new')}}</button>
                </a></div>
        </div>
        
            <div class="row card-deck my-5">
                <table class="table table-striped">
                	<tr>
                    	<th>Title</th>
                        <th>Description</th>
                    	<th>Amount</th>
                        <th>Duration (Days)</th>
                        
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                @foreach($subscriptions as $subscription)
                    <tr>
                    	<td>{{$subscription->name}}</td>
                        <td>{!!$subscription->description!!}</td>
                    	<td>{{$subscription->amount}}</td>
                        <td>{{$subscription->duration}}</td>
                       
                        <td>
                        @if($subscription->status==0)
                        	<span style="color:#CC6600; font-weight:bold;">Inactive!</span>
                        @else
                        	<span style="color:#00CC00;font-weight:bold;">Active</span>
                        @endif
                        </td>
                        <td><a href="{{route('edit_subscription',['id'=>$subscription->id])}}" class="text-muted"><i
                                            class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                                    <a href="{{route('delete_subscription',['id'=>$subscription->id])}}" onclick="return confirm('Delete Now ?');"
                                       class="text-muted pl-4"><i
                                            class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                        
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        

    </div>
@endsection
@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_subscription").addClass('active');
        });
    </script>
@endsection

