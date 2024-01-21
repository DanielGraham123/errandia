@extends('admin.layout')
@section('section')
    <form class="py-4">
        @csrf
        <div class="mx-auto border py-5 px-4" style="width: 36rem; border-radius: 0.9rem;">
            <div class="text-h6 text-capitalize my-3">Add new category</div>
            
            
            <div class="my-3">
                <input type="text" name="name" class="form-control input-field rounded" placeholder="Category name*" required>
            </div>
            <div class="my-3">
                <input type="file" name="image" class="form-control input-field rounded" placeholder="Category icon*">
            </div>
            <div class="py-3 mt-5 d-flex justify-content-between">
                <button type="submit" class="button-primary">save category</button>
                <a href="{{ URL::previous() }}" class="button-secondary">cancel</a>
            </div>
        </div>

    </form>
@endsection