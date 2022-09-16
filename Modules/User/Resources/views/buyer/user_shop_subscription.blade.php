@extends('helep.buyer.layout.master')
@section('page_title') @lang('buyer.buyer_sidebar_shops_subscribe_msg') @endsection
@section('title') @lang('buyer.buyer_sidebar_shops_subscribe_msg') @endsection
@section('content')
    <div class="container py-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <div class="clearfix"><br/></div>
        <div class="row card-deck my-5">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Shop</th>
                    <th>Subscription Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $counter=1; @endphp
                @foreach($subscriptions as $subscriber)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>
                            {{$subscriber->shop->name}}
                        </td>

                        <td style="white-space: normal ">{{ convert_date_to_human($subscriber->created_at)}}</td>
                        <td>
                            <a href="{{route('unsubscribe_shop',['user'=>$subscriber->user_id,'shop'=>$subscriber->shop_id])}}">
                                <button type="button" class="btn helep_btn_raise">
                                    <i class="fa fa-pause" aria-hidden="true"></i>UnSubscribe
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
            $("#buyer_sidebar_manage_shop_subscribe").addClass('active');
            $('#subscribersTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection

