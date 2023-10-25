@extends('admin.layout')

@section('section')

<div class="row col-md-6">
    <div class="py-4 px-5 shadow my-2" style="border-radius: 0.6rem;">
        <div class="text-h6 text-uppercase">user details</div>
        <div class="row">
            <img class="img img-rounded img-responsive mx-auto my-3" style=" width: 7rem; width: 7rem;" src="{{ $user->photo }}">
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Name</div>
            <div class="text-body col-sm-8 col-md-9">{{ $user->name }}</div>
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Status</div>
            <div class="text-body col-sm-8 col-md-9"> 
                <span class="label label-out label-warning mx-3">Suspended</span>
                <span> Suspended on: <i class="text-body-sm">{{ now() }}</i></span>
            </div>
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Phone</div>
            <div class="text-body col-sm-8 col-md-9">{{ $user->phone }}</div>
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Email</div>
            <div class="text-body col-sm-8 col-md-9">{{ $user->email }}</div>
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Member since</div>
            <div class="text-body col-sm-8 col-md-9">{{ $user->created_at->format('d m Y') }}</div>
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Location</div>
            <div class="text-body col-sm-8 col-md-9">{{ $user->address }}</div>
        </div>
        <div class="row py-3 border-bottom shadow-md">
            <div class="col-sm-4 col-md-3 text-extra">Shop</div>
            <div class="text-body col-sm-8 col-md-9">Clara Jada Schema</div>
        </div>
        <div class="d-flex py-4">
            <a class="button-secondary"> <img style="height: 1.6rem; width: 1.6rem;" src="{{ asset('assets/admin/icons/icon-edit.svg') }}"> Edit User</a>
            <a class="button-tertiary"> <img style="height: 1.6rem; width: 1.6rem;" src="{{ asset('assets/admin/icons/icon-manage-users.svg') }}"> Reactivate User</div>
        </div>
    </div>
    <div class="row col-md-6">
        <div class="py-4 px-5 shadow my-2 w-100" style="border-radius: 0.6rem;">
            <div class="text-h6 text-uppercase">Businesses</div>
            {{-- <form method="POST" class="border-bottom py-2" action="{{ route('admin.users.add_business') }}">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="business" required>
                        @foreach (\App\Models\Shop::orderBy('name')->get() as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="py-2 d-flex justify-content-end">
                    <button type="submit" class="button-secondary">add</button>
                </div>
            </form> --}}
            <table class="table table-light">
                <thead>
                    <th>#</th>
                    <th>Business</th>
                    <th>Category</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @php
                        $k = 1;
                    @endphp
                    @foreach (\App\Models\Shop::take(5)->get() as $shop)
                        <tr class=" border-bottom shadow-sm">
                            <td ></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection