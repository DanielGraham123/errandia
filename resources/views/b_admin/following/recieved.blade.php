@extends('b_admin.layout')
@section('section')
    <div class="py-3">
        <table class="table table-stripped">
            <thead class="text-capitalize">
                <th>###</th>
                <th>shop</th>
                <th>Subscriber</th>
                <th>Contact</th>
                <th>action</th>
            </thead>
            <tbody>
                @php
                    $k = 1;
                @endphp
                @foreach ($followings as $subs)
                    <tr>
                        <td>{{ $k++ }}</td>
                        <td>
                            <div class="text-center">
                                <span class="d-block">
                                    <img class="img img-thumbnail mx-auto" style="width: 3rem; height: 3rem;" src="{{ asset('uploads/logos/'.$subs->shop->image_path) }}">
                                </span>
                                <span class="fw-semibold">{{ $subs->shop->name??'' }}</span>
                            </div>
                        </td>
                        <td>{{ $subs->user->name??'' }}</td>
                        <td>{{ $subs->user->email??'' }} / {{ $subs->user->phone??'' }}</td>
                        <td>
                            <a class="button-secondary" href="{{ route('business_admin.following.unfollow', $subs->id) }}">unsubscribe</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection