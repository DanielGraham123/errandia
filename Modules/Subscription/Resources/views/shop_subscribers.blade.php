@extends('helep.vendor.layout.master')
@section('page_title') @lang('vendor.subscribers_list_page_title') @endsection
@section('title') @lang('vendor.subscribers_list_page_title') @endsection
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
                    <th>Subscriber</th>
                    <th>Subscription Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $counter=1; @endphp
                @foreach($subscribers as $subscriber)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>
                            {{$subscriber->user->name}}
                        </td>

                        <td style="white-space: normal ">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $subscriber->created_at)->diffForHumans()}}</td>
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
            $("#vendor_manage_orders").addClass('active');
            $('#subscribersTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection

