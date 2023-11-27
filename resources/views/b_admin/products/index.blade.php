@extends('b_admin.layout')
@section('section')
    <div class="py-2 container">
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <span><span class="text-h4 d-block">Products @if(isset($shop)) For {{ $shop->name }} <i class="text-link">({{ $shop->location() }})</i> @endif <span class="text-h6">({{ count($products) }})</span></span> <span class="d-block text-extra">Manage all your products</span></span>
            <span>@if(isset($shop))<a class="button-primary" href="{{ route('business_admin.products.create', $shop->slug) }}"><img src="{{ asset('assets/admin/icons/icon-add.svg') }}" style="height: 1.4rem; width: 1.4rem; margin-right: 0.3rem;">Add Product</a>@endif</span>
            <span class="d-inlineblock">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-right" id="myTab">
                        <li class="">
                            <a href="{{ Request::url() }}?action=all" aria-expanded="false">
                                All
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ Request::url() }}?action=published" aria-expanded="false">
                                Published
                            </a>
                        </li>

                        <li>
                            <a href="{{ Request::url() }}?action=draft" aria-expanded="true">
                                Draft
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ Request::url() }}?action=trash" aria-expanded="true">
                                Trash
                            </a>
                        </li>

                    </ul>
                </div>
            </span>
        </div>
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
                    @foreach($products as $key => $prod)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $key+1}}</td>
                            <td>
                                <span class="">
                                    <img style="height: 3rem; width: 3rem; border-radius: 0.5rem; border: 1px solid gray; margin: 0.4rem 0.7rem;" src="{{ asset($prod->featured_image) }}">
                                    <span style="color: var(--color-darkblue)">{{ $prod->name??"product name" }} <br>
                                    @foreach($prod->subCategories as $subCategory)
                                            <i class="text-link">{{ $subCategory->name }}, </i>
                                    @endforeach
                                    </span>
                                </span>
                            </td>
                            <td> <span class="text-link d-block">{{ $prod->unit_price ?? 'unit price' }}</span></td>
                            @if(!isset($shop)) <td> <span class="text-link d-block">{{ ($prod != null ? $prod->shop->name : 'Shop name') .' ('. ($prod != null ? $prod->shop->location() : 'Location') }})</span></td> @endif 
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('business_admin.enquiries.show', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.1rem;"> edit</a> <br>
                                    <a href="{{ route('business_admin.enquiries.show', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-view.svg') }}" style="height: 1.1rem;"> view details</a> <br>
                                    <a href="{{ route('business_admin.enquiries.mail', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-edit-photo.svg') }}" style="height: 1.1rem;"> edit photo</a> <br>
                                    <a href="{{ route('business_admin.enquiries.mail', $prod->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-unpublish.svg') }}" style="height: 1.1rem;"> unpublish</a> <br>
                                    <a href="#" onclick="_prompt(`{{ route('business_admin.enquiries.delete', $prod->slug??'slug') }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.1rem;"> Delete</a>
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