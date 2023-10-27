@extends('b_admin.layout')
@section('section')
    <div class="py-2 container">
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <span><span class="text-h4 d-block">Products <span class="text-h6">({{ count($products) }})</span></span> <span class="d-block text-extra">Manage all your products</span></span>
            <span>@if(isset($shop))<a class="button-primary" href="{{ route('business_admin.products.create', $shop->slug) }}"><img src="{{ asset('assets/admin/icons/icon-add.svg') }}" style="height: 1.4rem; width: 1.4rem; margin-right: 0.3rem;">Add Product</a>@endif</span>
        </div>
        <div class="py-1">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>product</th>
                    <th>price</th>
                    <th>created at</th>
                    <th>action</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach(count($products) > 0 ? $products : collect([null, null, null, null, null, null]) as $prod)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <span class="">
                                    <img style="height: 3rem; width: 3rem; border-radius: 0.5rem; border: 1px solid gray; margin: 0.4rem 0.7rem;" src="{{ asset('assets/admin/icons/icon-category-fashion.svg') }}">
                                    <span style="color: var(--color-darkblue)">{{ $prod->name??"product name" }} <br> <i class="text-link">{{ $prod->category->name??"product sub-category" }}</i></span>
                                </span>
                            </td>
                            <td> <span class="text-link d-block">{{ $prod->unit_price ?? 'unit price' }}</span></td>
                            <td>
                                <span class="text-quote d-block">Created</span>
                                <span class="text-extra d-block">{{ \Carbon\Carbon::parse($prod->created_at??'12-06-2041T10:07:34')->format('d-m-Y @ H:i:s') }}</span>
                                <span class="text-quote d-block">Updated</span>
                                <span class="text-extra d-block">{{ \Carbon\Carbon::parse($prod->updated_at??'12-06-2041T10:07:34')->format('d-m-Y @ H:i:s') }}</span>
                                
                            </td>
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