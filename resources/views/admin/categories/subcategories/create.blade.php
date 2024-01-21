@extends('admin.layout')
@section('section')
    <form class="py-4">
        @csrf
        <div class="mx-auto border py-5 px-4" style="width: 36rem; border-radius: 0.9rem;">
            <div class="text-h6 text-capitalize my-3">Add Sub-category</div>
            
            <div class=" my-3">
                <input type="text" name="name" class="form-control input-field rounded" placeholder="Sub-Category name*">
            </div>
            <div class=" my-3">
                <select name="category_id" class="form-control select-field rounded">
                    <option>select parent category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="py-3 mt-5 d-flex justify-content-between">
                <button type="submit" class="button-primary">save</button>
                <a href="{{ URL::previous() }}" class="button-secondary">cancel</a>
            </div>
        </div>

    </form>
@endsection