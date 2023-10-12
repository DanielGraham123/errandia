@extends('admin.layout')

@section('section')
    <div class="mx-3">
        <div class="form-panel">
            <form class="form-horizontal" role="form" method="POST" action="{{route('admin.users.store')}}">
                @csrf
                <div class="form-group @error('name') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">Full Name (required)</label>
                    <div class="col-lg-10">
                        <input class=" form-control" name="name" value="{{old('name')}}" type="text" required />
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group @error('email') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">{{__('text.word_email')}} ({{__('text.word_required')}})</label>
                    <div class="col-lg-10">
                        <input class=" form-control" name="email" value="{{old('email')}}" type="email" required />
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('phone') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">Phone</label>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <select class="form-control" name="phone_code">
                                @foreach (config('country-phone-codes') as $phcode)
                                    <option value="+{{ $phcode['code'] }}">{{ $phcode['country'] }} (+{{ $phcode['code'] }})</option>
                                @endforeach
                            </select>
                            <input class="form-control" name="phone" value="{{old('phone')}}" type="text" required />
                        </div>
                        @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('address') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">Address</label>
                    <div class="col-lg-10">
                        <input class=" form-control" name="address" value="{{old('address')}}" type="text" required />
                        @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('gender') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2"> User Type</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="user_type" required>
                            {{-- <option>Select user type</option> --}}
                            @foreach (\App\Models\UserType::all() as $type)
                                <option value="{{ $type->type }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="type" id="" value="{{request('type') ?? ''}}">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="button-primary" type="submit">Save</button>
                        <a class="button-secondary" href="{{route('admin.users.index')}}" type="button">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection