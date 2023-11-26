@extends('b_admin.layout')
@section('section')
    <div class="py-2 container">

        <div class="clearfix">
            <div class="pull-right tableTools-container">
                <div class="dt-buttons btn-overlap btn-group btn-bg">
                    @if(isset($shop))<a href="{{ route('business_admin.services.create', $shop->slug) }}" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-plus bigger-110 blue"></i> <span class="">Add</span></span></a>@endif
                    <a href="{{ Request::url() }}?action=all" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-search bigger-110 blue"></i> <span class="">All</span></span></a>
                    <a href="{{ Request::url() }}?action=published" class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-copy bigger-110 pink"></i> <span class="">Published</span></span></a>
                    <a href="{{ Request::url() }}?action=draft" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-database bigger-110 orange"></i> <span class="">Draft</span></span></a>
                    <a href="{{ Request::url() }}?action=trash" class="dt-button buttons-print btn btn-white btn-primary btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span><i class="fa fa-trash bigger-110 grey"></i> <span class="">Trash</span></span></a>
                </div>
            </div>
        </div>
        <div class="table-header">
            Products @if(isset($shop)) For {{ $shop->name }} <i class="text-body">({{ $shop->location() }})</i> @endif <span class="text-h6">({{ count($products) }})</span></span>
        </div>
        {{-- @dd($products) --}}
        <div class="py-1">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>product</th>
                    <th>price</th>
                    @if(!isset($shop)) <th>Branch</th> @endif
                    <th>action</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($products as $prod)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <span class="">
                                    <img style="height: 3rem; width: 3rem; border-radius: 0.5rem; border: 1px solid gray; margin: 0.4rem 0.7rem;" src="{{ asset('uploads/item_images/'.$prod->featured_image) }}">
                                    <span style="color: var(--color-darkblue)">{{ $prod->name??"product name" }}</span>
                                </span>
                            </td>
                            <td> <span class="text-link d-block">{{ $prod->unit_price ?? 'unit price' }}</span></td>
                            @if(!isset($shop)) <td> <span class="text-link d-block">{{ ($prod != null ? $prod->shop->name : 'Shop name') .' ('. ($prod != null ? $prod->shop->location() : 'Location') }})</span></td> @endif 
                            <td>

                                <div class="dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon icon-only"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="{{ route('business_admin.enquiries.show', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.1rem;"> edit</a></li>
                                        <li class="dropdown-item"><a href="{{ route('business_admin.enquiries.show', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-view.svg') }}" style="height: 1.1rem;"> view details</a></li>
                                        <li class="dropdown-item"><a href="{{ route('business_admin.enquiries.mail', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-edit-photo.svg') }}" style="height: 1.1rem;"> edit photo</a></li>
                                        <li class="dropdown-item"><a href="{{ route('business_admin.enquiries.mail', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-unpublish.svg') }}" style="height: 1.1rem;"> unpublish</a></li>
                                        <li class="dropdown-item"><a href="#" onclick="_prompt(`{{ route('business_admin.enquiries.delete', $prod->slug??'slug') }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.1rem;"> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>@if ($prod->status??null == 1)
                                <span class="text-quote"><img class="mr-2" style="height: 1.2rem; width: 1.2rem; " src="{{ asset('assets/badmin/icon-check-circle.svg') }}"> Published</span>
                            @else
                                <span class="text-quote"><img class="mr-2" style="height: 1.2rem; width: 1.2rem; " src="{{ asset('assets/badmin/icon-cancelled.svg') }}"> Unpublished</span>
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection