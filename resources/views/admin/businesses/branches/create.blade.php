@extends('admin.layout')
@section('section')
<form method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Business Branch details</div>
            <div class="row mx-5 my-2">
                <div class="col-md-12 px-2 py-2">
                    <input type="text" name="name" class="form-control" value="{{ old('name', $business->name) }}" placeholder="Business Name">
                </div>
                <div class="col-md-12 px-2 py-2">
                    <select name="category" class="form-control" placeholder="">
                        <option>Business categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category', $business->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 px-2 py-2">
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $business->description) }}</textarea>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="region" class="form-control" oninput="loadTowns(event)" required>
                        <option>Region</option>
                        @foreach ($regions as $reg)
                            <option value="{{ $reg->id }}" {{ old('region', $business->region_id) == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="town" class="form-control" id="town_selection" oninput="loadStreets(event)" required>
                        <option>Town</option>
                        @foreach ($towns as $tn)
                            <option value="{{ $tn->id }}" {{ old('town', $business->town_id) == $tn->id ? 'selected' : '' }}>{{ $tn->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="street" class="form-control" id="street_selection">
                        <option>Street</option>
                        @foreach ($streets as $st)
                            <option value="{{ $st->id }}" {{ old('street', $business->street_id) == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <div class="input-group">
                        <span class="input-group-addon fa fa-phone text-h6"></span>
                        <select class="form-control w-25" name="phone_code">
                            @foreach (config('country-phone-codes') as $phcode)
                                <option value="+{{ $phcode['code'] }}" {{ old('phone_code') == $phcode ? 'selected' : '' }}>{{ $phcode['country'] }} (+{{ $phcode['code'] }})</option>
                            @endforeach
                        </select>
                        <input class="form-control" name="phone" value="{{old('phone')}}" type="number" required />
                    </div>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <div class="input-group">
                        <span class="input-group-addon fa fa-whatsapp text-h6"></span>
                        <select class="form-control" name="whatsapp_phone_code">
                            @foreach (config('country-phone-codes') as $phcode)
                                <option value="+{{ $phcode['code'] }}" {{ old('whatsapp_phone_code') == $phcode ? 'selected' : '' }}>{{ $phcode['country'] }} (+{{ $phcode['code'] }})</option>
                            @endforeach
                        </select>
                        <input class="form-control" name="whatsapp_phone" value="{{old('whatsapp_phone')}}" type="number" placeholder="Whatstapp phone number" />
                    </div>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="email" name="email" class="form-control" value="{{ old('email', $business->email) }}" placeholder="Business Email">
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="url" name="website" class="form-control" value="{{ old('website', $business->website) }}" placeholder="Business website">
                </div>
            </div>
        </div>

        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Verification</div>
            <div class="px-2 py-2 mx-4 flex">
                Verification Status: 
                <span class="mx-4"><input type="radio" name="verification_status" {{ old('verification_status') == 1 ? 'checked' : '' }} value="1" class="mx-3" required>verified</span>
                <span class="mx-4"><input type="radio" name="verification_status" {{ (old('verification_status') == 0 || old('verification_status') == null) ? 'checked' : '' }} checked value="0" class="mx-3" required>unverified</span>
            </div>
        </div>
        <div class="py-2">
            <button href="#" class="button-primary btn-lg">Add Business</button>
        </div>
    </div>
</form>
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