@extends('admin.layout')

@section('section')
    <div class="mx-3">
        <div class="form-panel">
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{route('admin.users.store')}}">
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
                    <label for="cname" class="control-label col-lg-2">Email (optional)</label>
                    <div class="col-lg-10">
                        <input class=" form-control" name="email" value="{{old('email')}}" type="email"  />
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('phone') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">Phone</label>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <span class="fa fa-phone fa-2x text-primary py-2 px-3"></span>
                            <select class="form-control w-25" name="phone_code">
                                @foreach (config('country-phone-codes') as $phcode)
                                    <option value="+{{ $phcode['code'] }}">{{ $phcode['country'] }} (+{{ $phcode['code'] }})</option>
                                @endforeach
                            </select>
                            <input class="form-control" name="phone" value="{{old('phone')}}" type="number" required />
                        </div>
                        @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group @error('photo') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">Profile photo (optional)</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="photo" type="file" >
                        @error('photo')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('street') has-error @enderror">
                    <label for="cname" class="control-label col-lg-2">Address</label>
                    <div class="col-lg-10">
                        <div class="py-2">
                            <select name="region" class="form-control" oninput="loadTowns(event)" required>
                                <option>Region</option>
                                @foreach ($regions as $reg)
                                    <option value="{{ $reg->id }}" {{ old('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="py-2">
                            <select name="town" class="form-control" id="town_selection" oninput="loadStreets(event)" required>
                                <option>Town</option>
                            </select>
                        </div>
                        <div class="py-2">
                            <select name="street" class="form-control" id="street_selection">
                                <option>Street</option>
                            </select>
                        </div>
                    </div>
                </div>
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
@section('script')
    <script>
        let loadTowns = function(event){
            let region = event.target.value;
            if(region != null){
                let route = "{{ route('admin.region.towns', '__ID__') }}".replace('__ID__', region);
                $.ajax({
                    method: 'get', url: route, success: function(response){
                        if(response.data != null){
                            console.log(response.data);
                            let html = `<option>Town</option>`;
                            response.data.forEach(element=>{
                                html += `<option value="${element.id}">${element.name}</option>`;
                            })
                            $('#town_selection').html(html);
                        }
                    }
                })
            }
        }
        let loadStreets = function(event){
            let town = event.target.value;
            if(town != null){
                let route = "{{ route('admin.town.streets', '__ID__') }}".replace('__ID__', town);
                $.ajax({
                    method: 'get', url: route, success: function(response){
                        if(response.data != null){
                            console.log(response.data);
                            let html = `<option>Street</option>`;
                            response.data.forEach(element=>{
                                html += `<option value="${element.id}">${element.name}</option>`;
                            })
                            $('#street_selection').html(html);
                        }
                    }
                })
            }
        }
    </script>
@endsection