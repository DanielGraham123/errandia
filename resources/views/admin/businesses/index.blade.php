@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-end py-3 px-2">
            <a href="{{ route('admin.businesses.create') }}" class=" btn btn-primary bg-sm py-2 px-4 text-white text-capitalize rounded"><span class="text-white fa fa-plus mx-2"></span>Add new business</a>
        </div>
        <div class="py-1 px-2 d-flex">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>name</th>
                    <th>Categories</th>
                    <th>business owner</th>
                    <th>Created</th>
                    <th>action</th>
                    <th>Statistic</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($businesses as $business)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>
                                <div class="row border-0 bg-white">
                                    <span class="col-sm-2">
                                        <span class="fa fa-certificate fa-2x text-primary"></span>
                                    </span>
                                    <div class="col-sm-10">
                                        <span class="d-block my-1 h5 my-2 text-dark">{{ $business->name }}</span>
                                        <span class="label label-sm label-info arrowed-in">Head Office</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $business->category->name ?? null }}</td>
                            <td>
                                {{$business->user->name??null}}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($business->created_at)->format('D dS M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon fa fa-caret-down icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-light">
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.show', $business->slug) }}" class="text-decoration-none text-secondary">view</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.edit', $business->slug) }}" class="text-decoration-none text-secondary">edit</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{route('admin.businesses.branch.index', $business->slug)}}" class="text-decoration-none text-secondary">branches</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.show_owner', $business->slug) }}" class="text-decoration-none text-secondary">view owner profile</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.suspend', $business->slug) }}" onclick="_prompt('url', 'Are you sure you intend to suspend this item?')" class="text-decoration-none text-secondary">suspend</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.verify', $business->slug) }}" class="text-decoration-none text-secondary">Mark as verified</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" onclick="_prompt(`{{ route('admin.businesses.delete', $business->slug) }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none text-secondary">Delete</a></li>
                                    </ul>
                                </div>
                             </td>
                            <td>
                                <span class="d-block my-1">products: <span class="text-success ml-2">{{ $business->products->where('is_service', 0)->count() }}</span> </span>
                                <span class="d-block my-1">services: <span class="text-primary ml-2">{{ $business->products->where('is_service', 1)->count() }}</span> </span>
                                <span class="d-block my-1">views: <span class="text-primary ml-2">{{ $business->products()->select(\DB::raw(`SUM(items.views) as total_views`))->first() }}</span> </span>
                            </td>
                            <td>
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection