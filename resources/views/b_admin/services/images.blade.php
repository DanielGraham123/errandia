@extends('b_admin.c_layout')
@section('section')
@php
    $_step = $step ?? 1
@endphp
    <div class="container">
        <div class="table-header">
            Edit Product
        </div>
        
        <form method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-body">
                    <span class="text-info">New Images:</span>
                    <div class="input-images"></div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <span class="text-info">Saved Images:</span>
                    <div class="row g-2">
                    @foreach ($product->images as $img)
                        <div class="border rounded-md p-3 col-6 col-md-4 col-xl-3">
                            <input type="checkbox" name="saved[]" checked value="{{ $img->id }}">
                            <img class="img img-responsive img-rounded" style="width: 10rem; height: 10rem;" src="{{ asset('uploads/item_images/'.$img->image) }}">
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-3">
                <button class="btn btn-xs btn-primary" type="submit">@lang('text.word_update')</button>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script>
        $('.input-images').imageUploader();
    </script>
@endsection