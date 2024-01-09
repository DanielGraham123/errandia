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
                {{-- <div class="row my-3">
                    <label class="col-md-3 text-info fw-5 text-capitalize">gender</label>
                    <div class="col-md-9">
                        <select class="form-control input-sm" name="gender">
                            <option></option>
                            <option value="{{ male }}" {{ 'male' == old('gender', $user->gender) ? 'selected' : '' }}>Male</option>
                            <option value="{{ female }}" {{ 'female' == old('gender', $user->gender) ? 'selected' : '' }}>Female</option>
                            <option></option>
                        </select>
                    </div>
                </div> --}}
                <div class="row my-3">
                    <label class="col-md-3 text-info fw-5 text-capitalize">phone</label>
                    <div class="col-md-9 d-flex">
                        <div class="w-50">
                            <select class="form-control input-sm" name="phone_country_code" required>
                                <option></option>
                                @foreach (config('country-phone-codes') as $phcode)
                                    <option value="{{ $phcode['code'] }}" {{ old('phone_country_code', $user->phone_country_code) == $phcode['code'] ? 'selected' : '' }}>{{ $phcode['country'] }} ( {{ $phcode['code'] }} )</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-50">
                            <input type="tel" class="form-control input-sm" name="phone" required value="{{ old('phone', $user->phone) }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end my-3">
                    <button class="button-secondary text-uppercase" type="submit">update</button>
                </div>
            </form>
        </div>
        <div class="col-md-9 mx-auto py-4 rounded-md px-2">
            <div class="d-flex justify-content-end py-2">
                <img style="width: 8rem; height: 8rem, border-radius: 0.5rem; border: 0.2rem ridge white;" id="picture_preview">
            </div>
            <h3 class="text-center text-secondary fw-bold fs-2 mb-3">Update Profile Photo</h3>
            <form method="POST" action="{{ route('business_admin.settings.profile.update_photo') }}" enctype="multipart/form-data">
                @csrf
                <div class="row my-3">
                    <label class="col-md-3 text-info fw-5 text-capitalize">photo</label>
                    <div class="col-md-9">
                        <input class="form-control input-sm" onchange="preview_profile(event)" type="file" accept="image/*" name="image" required value="{{ old('name', $user->name) }}">
                    </div>
                </div>
                <div class="d-flex justify-content-end my-3">
                    <button class="button-secondary text-uppercase" type="submit">update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let preview_profile = function(evnt){
            let file = evnt.target.files[0];
            let src = URL.createObjectURL(file);
            $('#picture_preview').prop('src', src);
        }
    </script>
@endsection