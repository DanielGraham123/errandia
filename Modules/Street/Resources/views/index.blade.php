@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.sidebar_manage_street') @endsection
@section('title') @lang('admin.sidebar_manage_street') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap">
                <a href="{{route('add_street')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_street_new')}}
                    </button>
                </a>
            </div>
        </div>
        {{--        <div class="row card-deck my-5">--}}
        {{--            @foreach($street as $st)--}}
        {{--                <div class="col-md-4 card helep_round col-lg-4 mb-5">--}}
        {{--                    <a href="">--}}
        {{--                        <div class="card-body">--}}
        {{--                            <p class="font-weight-bold">Town : {{$st->townName}}</p>--}}
        {{--                            <h5 class="card-title text-black-50 font-weight-bold">{{$st->name}}</h5>--}}
        {{--                            <p class="card-text text-black-50">{{$st->description}}</p>--}}
        {{--                            <p class="card-text">--}}
        {{--                                <a href="{{route('edit_street',['id'=>$st->id])}}" class="text-muted">--}}
        {{--                                    <i class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}--}}
        {{--                                </a>--}}
        {{--                                <a href="{{route('delete_street',['id'=>$st->id])}}"--}}
        {{--                                   onclick="return confirm('Delete Now ?');" class="text-muted pl-4">--}}
        {{--                                    <i class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}--}}
        {{--                                </a>--}}
        {{--                            </p>--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}
        <table id="streetTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Town</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php $counter=1; @endphp
            @foreach($street as $st)
                <tr>
                    <td>{{$counter++}}</td>
                    <td>{{$st->name}}</td>
                    <td>{{$st->townName}}</td>
                    <td>
                        <a href="{{route('edit_street',['id'=>$st->id])}}" class="text-muted p-1 m-1"><i
                                class=" fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                        <a href="{{route('delete_street',['id'=>$st->id])}}" class="text-muted"><i
                                class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                    </td>
                </tr>
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
            $("#sidebar_manage_street").addClass('active')
            $('#streetTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
@endsection
