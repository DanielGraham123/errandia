@extends('b_admin.layout')
@section('section')
    <div class="py-4">
        <div class="col-md-9 mx-auto py-4 rounded-md px-2">
            <h3 class="text-center text-secondary fw-bold fs-2 mb-3">Edit User Profile</h3>
            <form method="POST">
                @csrf
                <div class="row my-3">
                    <label class="col-md-3 text-info fw-5 text-capitalize">Name</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" name="name" required value="{{ old('name', $user->name) }}">
                    </div>
                </div>
                <div class="row my-3">
                    <label class="col-md-3 text-info fw-5 text-capitalize">email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control input-sm" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                </div>
                <div class="row my-3">
                    <label class="col-md-3 text-info fw-5 text-capitalize">phone</label>
                    <div class="col-md-9">
                        <input type="tel" class="form-control input-sm" name="phone" required value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>
                <div class="d-flex justify-content-end my-3">
                    <button class="btn btn-sm btn-outline-primary text-uppercase" type="submit">update</button>
                </div>
            </form>
        </div>
    </div>
@endsection