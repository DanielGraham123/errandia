@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="my-2 d-flex justify-content-end">
            <a class="button-secondary" href="{{ route('admin.faqs.create') }}">Create FAQ Item</a>
        </div>
        <table class="table table-stripped">
            <thead class="text-capitalize">
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
            </thead>
            <tbody>
                @php
                    $k = 1;
                @endphp
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{ $k++ }}</td>
                        <td>{{ $faq->title??'' }}</td>
                        <td>{!! $faq->content??'' !!}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.faqs.edit', $faq->id) }}">edit</a>
                            <form action="{{ route('admin.faqs.delete', $faq->id) }}" method="POST">
                                <button class="btn btn-xs btn-danger" type="submit">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection