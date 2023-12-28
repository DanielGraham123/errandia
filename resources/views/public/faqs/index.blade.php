@extends('public.layout')
@section('section')
    <div class="py-2">
        <div class="container">
            @foreach ($faqs as $faq)
                <div class="py-1 border-top border-bottom">
                    <div class="py-1">
                        <h4 class="fw-semibold text-secondary">{{ $faq->title }}</h4>
                        <p>{!! $faq->content !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-around">{{ $faqs->links() }}</div>
    </div>
@endsection