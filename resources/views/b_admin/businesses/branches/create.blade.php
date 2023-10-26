@extends('b_admin.businesses.layout')
@section('section')
<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex">
        <div class="py-4 my-5 px-3 col-sm-9 col-md-7 col-lg-6 shadow mx-auto" style="border-radius: 0.8rem;">
            <div class="text-h6 text-center text-uppercase my-3">Business details</div>
            <div class="mx-5 my-2">
                <div class="px-2 py-2">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
                </div>
                <div class="px-2 py-2">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                </div>

                <div class="px-2 py-2">
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="password">
                </div>
                
                <div class="px-2 py-2">
                    <input type="password" name="confirm_password" class="form-control" value="{{ old('confirm_password') }}" placeholder="confirm password">
                </div>
            </div>

            <div class="mx-5 my-2">
                <div class="text-h6 text-center text-uppercase my-3">Assign to Shop</div>
                <div class="px-2 py-2">
                    <select name="business_id" class="form-control">
                        <option></option>
                        @foreach ($businesses as $business)
                            <option value="{{ $business->id }}">{{ $business->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mx-5 my-2">
                <button href="#" class="button-primary btn-lg mx-auto">Add Manager</button>
            </div>
        </div>

    </div>
</form>
@endsection