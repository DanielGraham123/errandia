@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.user_list_msg') @endsection
@section('title') @lang('admin.user_list_msg') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>

        <div>
            <table id="userTable" class="table table-striped">
                <thead>
                <tr>
                    <th>User Type</th>
                    <th>User Name</th>
                    <th>Email ID</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->user_type==0?'Vendor':($user->user_type==1?'Customer':'')}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->tel}}</td>
                        <td>
                            @if($user->status==0)
                                <span style="color:#CC6600; font-weight:bold;">Suspended!</span>
                            @else
                                <span style="color:#00CC00;font-weight:bold;">Active</span>
                            @endif
                        </td>
                        <td><a href="#">
                                <button type="button" class="btn helep_btn_raise"><i class="fa fa-key"
                                                                                     aria-hidden="true"></i> Reset
                                    Password
                                </button>
                            </a>
                            @if($user->status==1)
                                <a href="{{route('suspendaccount',['id'=>$user->id])}}">
                                    <button type="button" class="btn helep_btn_raise"><i class="fa fa-pause"
                                                                                         aria-hidden="true"></i> Suspend
                                        Account
                                    </button>
                                </a>
                            @else
                                <a href="{{route('activeaccount',['id'=>$user->id])}}">
                                    <button type="button" class="btn helep_btn_raise"><i class="fa fa-pause"
                                                                                         aria-hidden="true"></i> Active
                                        Account
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $users->links() !!}
        </div>
    </div>
@endsection
@section("css")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('js')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js">

    </script>

    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_users").addClass('active');
            $('#userTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection
