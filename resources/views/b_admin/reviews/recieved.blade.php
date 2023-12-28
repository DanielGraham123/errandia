@extends('b_admin.c_layout')
@section('section')
    <table class="table">
        <thead class="text-capitalize table-stripped">
            <th>###</th>
            <th>Shop</th>
            <th>Item</th>
            <th>Review</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php
                $k = 1;
            @endphp
            @foreach($reviews as $key => $review)
                <tr>
                    <td>{{ $k++ }}</td>
                    <td>{{ $review->product->shop->name??'' }}</td>
                    <td><img class="img img-thumbnail m-2" style="height:3rem; width:auto; " src="{{ asset('uploads/item_images/'.$review->product->featured_image??'') }}"> <br> {{ $review->product->name??'' }}</td>
                    <td> 
                        <span class="d-flex">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="fa fa-star mx-1 fs-3 {{ $review->rating >= $i ? 'text-warning' : 'text-secondary' }}"></span>
                            @endfor
                        </span> <br> 
                        {{ $review->review??'' }}
                    </td>
                    <td><a href="{{ route('public.products.show', $review->product->slug) }}?review={{ $review->id }}" class="btn btn-xs btn-outline-success">view on site</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection