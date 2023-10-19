@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="py-1 px-2 d-flex">

            <table class="table table-stripped">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>Posted By</th>
                    <th>Search location</th>
                    <th>status</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($errands as $errn)
                        <tr class="shadow-md border-bottom bordere-dark">
                            <td>{{ $k++}}</td>
                            <td>
                                <div class="row border-0 bg-white">
                                    <span class="col-sm-2" style="hieght: 4rem; width: 4rem; border-radius: 0.5rem;">
                                        <img style="hieght: 4rem; width: 4rem; border-radius: 0.5rem;" src="{{ asset('assets/admin/images/admin-profile-pic.png') }}">
                                    </span>
                                    <div class="col-sm-10">
                                        <span class="d-block my-1 h5 text-primary">{{ $errn->title }}</span>
                                        <span class="text-secondary d-block">{{ $errn->description }}</span>
                                        <span class="d-block mt-4 h5 text-dark">{{ \Illuminate\Support\Carbon::parse($errn->created_at)->format(DATE_ATOM) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block text-info my-2">{{ $errn->posted_by->name??'' }}</span>
                                <span class="d-block my-2">Phone: {{ $errn->phone_number }}</span>
                            </td>
                            <td>
                                Molyko, Buea, South West Region
                            </td>
                            <td>
                                @if ($errn->read_status == 1)
                                    <span class="label label-out label-primary label-lg">Found</span>
                                @else
                                    <span class="label label-out label-warning label-lg">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="text-primary d-flex"><img src="{{ asset('assets/admin/icons/icon-view.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"> View on site</a>
                                <a href="#" class="text-danger d-flex" onclick="_prompt('url', 'Are you sure you intend to delete this item? This process cannot be undone.')"><img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div>{{ $errands->links() }}</div>
    </div>
@endsection