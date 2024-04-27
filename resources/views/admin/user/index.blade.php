@extends('admin.layout')

@section('section')
    <div class="col-sm-12">
        <p class="text-muted">
            <a href="{{route('admin.users.create')}}" class="button-primary text-capitalize">Add new user</a>
        </p>

        <div class="content-panel">
            <div>
                <table cellpadding="0" cellspacing="0" class="table" id="hidden-table-info">
                    <thead>
                    <tr class="text-capitalize">
                        <th>#</th>
                        <th>name</th>
                        <th>user role</th>
                        <th>phone number</th>
                        <th>email</th>
                        <th>since</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $k=>$user)
                            <tr>
                                <td>{{ $k++}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->type??'' }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                                <td> <span class="label label-sm label-info arrowed arrowed-righ">Active</span> </td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                            Actions
                                            <span class="ace-icon fa fa-caret-down icon-only"></span>
                                        </button>

                                        <ul class="dropdown-menu dropdown-light">
                                            <li class="list-item py-1 border-y"> <a href="{{ route('admin.users.show', $user->id) }}" class="text-decoration-none text-secondary">view profile</a></li>
                                            <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">edit</a></li>
                                            <li class="list-item py-1 border-y"> <a href="{{route('admin.businesses.show', '123')}}" class="text-decoration-none text-secondary">view business profile</a></li>
                                            <li class="list-item py-1 border-y"> <a href="#" onclick="_prompt('url', 'Are you sure you intend to ban this item?')" class="text-decoration-none text-secondary">Ban User</a></li>
                                            <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">Reactivate</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                </div>
            </div>
        </div>
    </div>
@endsection
