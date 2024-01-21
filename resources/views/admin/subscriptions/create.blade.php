@extends('admin.layout')
@section('section')
    <form class="py-4" method="post">
        @csrf
        <div class="shadow py-5 px-4" style="border-radius: 0.6rem;">
            
            <div class=" my-3">
                <input type="text" name="name" class="form-control rounded input input-lg" placeholder="Title*">
            </div>
            <div class=" my-3 input-group imput-group-merge rounded-md">
                <div class="input-group-addon px-0 mx-0" style="width: 7rem;">
                    <select class="input border-0 bg-transparent" name="currency">
                        <option></option>
                        @foreach (\App\Models\Country::distinct()->pluck('code') as $crty)
                            <option value="{{ $crty }}" {{ $crty == 'XAF' ? 'selected' : '' }}>{{ $crty }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" name="amount" class="form-control input input-lg rounded" placeholder="Amount*">
            </div>
            <div class=" my-3 input-group imput-group-merge rounded-md">
                <input type="number" name="duration" class="form-control input input-lg rounded" placeholder="number of Days" >
                <div class="input-group-addon px-0 mx-0" style="width: 7rem;">
                    Days
                </div>
            </div>
            <div class=" my-3 input-group imput-group-merge rounded-md">
                <textarea name="description" rows="4" class="form-control input input-lg rounded" >Description</textarea>
            </div>
            
            <div class="py-3 mt-5 d-flex justify-content-between">
                <button type="submit" class="button-primary">save</button>
                <a href="{{ URL::previous() }}" class="button-secondary">cancel</a>
            </div>
        </div>

    </form>
@endsection