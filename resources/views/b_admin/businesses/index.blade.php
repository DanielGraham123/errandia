@extends('b_admin.layout')
@section('section')
    <div class="py-2 container">
        
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <div class="about-us-title text-center">
                <h4>Manage all your Businesses</h4>
                <h2 class="center">Manage Businesses</h2>
            </div>
           
            <span><span class="text-h4 d-block"> </span> <span class="d-block text-extra"></span></span>
            <span>
                <a href="{{ route('business_admin.businesses.create') }}" class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color"><span class="text-white fa fa-plus mx-2"></span>Add new business</a>
            </span>
        </div>
        <div class="py-1 px-2 d-flex">

            <table class="table table-responsive">
                <thead class="text-capitalize">
                    <th></th>
                    <th>name</th>
                    <th>location</th>
                     
                    
                    <th>action</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($businesses as $business)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>{{ $business->name }}
                                {{-- <div class="row border-0">
                                    <span class="col-sm-2">
                                        <span class="fa  fa-handshake-o fa-2x text-primary"></span>
                                    </span>
                                    <div class="col-sm-10" style="font-size:12px">
                                        <span class="d-block my-1 h5 my-2 text-dark" style="font-size:12px">{{ $business->name }}</span>
                                        <span><span class="text-quote"> 4 Products</span><span class="text-body-sm"> 2 Services</span></span>
                                    </div>
                                </div> --}}
                            </td>
                            <td>{{ $business->location() }} @if($business->is_branch == 0) <BR><span class="label label-success rounded arrow-in">
                                Head Office<span> @endif</td>
                             
                            <td>

                                <div class="dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-light">
                                        <li class="dropdown-item py-1 border-y"> <a href="{{ route('business_admin.businesses.edit', $business->slug) }}" class="text-decoration-none text-secondary">edit</a></li>
                                        <li class="dropdown-item py-1 border-y"> <a href="{{ route('business_admin.businesses.show', $business->slug) }}" class="text-decoration-none text-secondary">view</a></li>
                                        <li class="dropdown-item py-1 border-y"> <a href="{{ route('business_admin.products.index', $business->slug) }}" class="text-decoration-none text-secondary">products</a></li>
                                        <li class="dropdown-item py-1 border-y"> <a href="{{ route('business_admin.services.index', $business->slug) }}" class="text-decoration-none text-secondary">services</a></li>
                                        <li class="dropdown-item py-1 border-y"> <a href="{{ route('business_admin.managers.index', $business->slug) }}" class="text-decoration-none text-secondary">managers</a></li>
                                        @if ($business->parent_slug == null)
                                            <li class="dropdown-item py-1 border-y"> <a href="{{route('business_admin.businesses.branch.create', $business->slug)}}" class="text-decoration-none text-secondary">add branch</a></li>
                                        @endif
                                        <li class="dropdown-item py-1 border-y"> <a href="#" onclick="_prompt(`{{ route('business_admin.businesses.suspend', $business->slug) }}`, 'Are you sure you intend to suspend this item?')" class="text-decoration-none text-secondary">suspend</a></li>
                                        <li class="dropdown-item py-1 border-y"> <a href="#" onclick="_prompt(`{{ route('business_admin.businesses.delete', $business->slug) }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none text-secondary">Delete</a></li>
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