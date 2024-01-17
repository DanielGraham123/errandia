@extends('admin.layout')
@section('section')
    <form class="py-4" method="POST">
        @csrf
        <div class="mx-auto border py-5 px-4" style="width: 36rem; border-radius: 0.9rem;">
            <div class="text-h6 text-capitalize my-3">Edit street</div>
            
            <div class=" my-3">
                <input type="text" name="name" class="form-control input-field rounded" value="{{ $street->name }}" placeholder="street Name*">
            </div>
            <div class=" my-3">
                <select name="town_id" class="form-control select-field rounded">
                    <option>select town</option>
                    @foreach ($towns as $tn)
                        <option value="{{ $tn->id }}" {{ $street->town_id == $tn->id ? 'selected' : '' }}>{{ $tn->name }}</option>
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