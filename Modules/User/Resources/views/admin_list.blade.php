@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.view_admin_title_msg') @endsection
@section('title') @lang('admin.view_admin_title_msg') @endsection
@section('content')
    <div class="container p-2">

        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_admin_page')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_admin_btn_msg')}}</button>
                </a></div>
        </div>
        <br/>
        <div>
            <table id="adminTable" class="table table-striped nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>User Name</th>
                    <th>Email ID</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @php $counter=0; @endphp
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{++$counter}}</td>
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
                        <td>
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
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_admin").addClass('active');
            $('#adminTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection
