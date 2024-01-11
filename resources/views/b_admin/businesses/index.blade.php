@extends('b_admin.layout')
@section('section')
    <div class="py-2 container">
        
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <div class="about-us-title text-center">
                <h4>Manage all your Businesses</h4>
                <h2 class="center">Manage Businesses</h2>
            </div>
           
            <span><span class="text-h4 d-block"> </span> <span class="d-block text-extra"></span></span>
            <div class="clearfix">
                <div class="pull-right tableTools-container">
                    <div class="dt-buttons btn-overlap btn-group btn-bg">
                        {{-- @if(isset($shop))<a href="{{ route('business_admin.products.create', ["shop_slug" =>$shop->slug]) }}" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-plus bigger-110 blue"></i> <span class="">Add</span></span></a>@endif --}}
                        <a href="{{ Request::url() }}?action=all" class="dt-button buttons-print btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-bars bigger-110 grey"></i> <span class="">All</span></span></a>
                        <a href="{{ Request::url() }}?action=trash" class="dt-button buttons-print btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-trash bigger-110 grey"></i> <span class="">Trashed</span></span></a>
                        <a href="{{ route('business_admin.businesses.create') }}" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-plus bigger-110 orange"></i> <span class="">AdNew Business</span></span></a>
                    </div>
                </div>
            </div>
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
                                        @if ($business->status == 1)
                                            <li class="dropdown-item py-1 border-y"> <a onclick="_prompt(`{{ route('business_admin.businesses.suspend', $business->slug) }}`, 'Are you sure you intend to suspend this item?')" class="text-decoration-none text-secondary">suspend</a></li>
                                        @else
                                            <li class="dropdown-item py-1 border-y"> <a onclick="_prompt(`{{ route('business_admin.businesses.suspend', $business->slug) }}`, 'Are you sure you intend to activate this item?')" class="text-decoration-none text-secondary">activate</a></li>
                                        @endif
                                        <li class="dropdown-item py-1 border-y"> <a onclick="_prompt(`{{ route('business_admin.businesses.delete', $business->slug) }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none text-secondary">Delete</a></li>
                                    </ul>
                                </div>
                             </td>
                            <td>
                                @if ($business->status == 1)
                                    <span class="bdge bdge-success">Active</span>
                                @else
                                    <span class="bdge bdge-danger">Suspended</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection