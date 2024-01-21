@extends('manager.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <span><span class="text-h4 d-block">Manage Businesses</span> <span class="d-block text-extra">Manage all your shops</span></span>
        </div>
        <div class="py-1 px-2 d-flex">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>name</th>
                    <th>location</th>
                    <th>created at</th>
                    <th>Managed By</th>
                    <th>action</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach([$businesses] as $business)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <div class="row border-0 bg-white">
                                    <span class="col-sm-2">
                                        <span class="fa fa-certificate fa-2x text-primary"></span>
                                    </span>
                                    <div class="col-sm-10">
                                        <span class="d-block my-1 h5 my-2 text-dark">{{ $business->name }}</span>
                                        <span><span class="text-quote"> 4 Products</span><span class="text-body-sm"> 2 Services</span></span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $business->location() }} @if($business->is_branch == 0) <span class="label label-success rounded arrow-in">Head Office<span> @endif</td>
                            <td>{{ \Carbon\Carbon::parse($business->created_at)->format('d-m-Y @ H:i:s') }}</td>
                            <td>{{ $business->manager->name??'manager' }}</td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon fa fa-caret-down icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-light">
                                        <li class="list-item py-1 border-y"> <a href="{{ route('manager.businesses.show', $business->slug) }}" class="text-decoration-none text-secondary">view</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('manager.products.index', $business->slug) }}" class="text-decoration-none text-secondary">products</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('manager.services.index', $business->slug) }}" class="text-decoration-none text-secondary">services</a></li>
                                    </ul>
                                </div>
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