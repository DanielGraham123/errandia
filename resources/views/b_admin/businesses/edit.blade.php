@extends('b_admin.layout')
@section('section')
<form method="POST" enctype="multipart/form-data" onsubmit="formReload()">
    @csrf
    <div>
        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Business details</div>
            <div class="row mx-5 my-2">
                <div class="col-md-12 px-2 py-2">
                    <input type="text" name="name" class="form-control" value="{{ old('name', $shop->name) }}" required placeholder="Business Name">
                </div>
                <div class="col-md-8 px-2 py-2">
                    <span class="text-capitalize">Logo</span>
                    <input type="file" name="image" accept="image/*" class="form-control" value="{{ old('image') }}" placeholder="Logo">
                </div>
                <div class="col-md-4 px-2 py-2">
                    <img src="{{ asset('uploads/logos/'.$shop->image_path) }}" style="height:7rem; width:7rem; border-radius:0.3rem;">
                </div>
                
                <div class="col-md-12 px-2 py-2">
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $shop->description??'') }}</textarea>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="region" class="form-control" oninput="loadTowns(event)" required>
                        <option>Region</option>
                        @foreach ($regions as $reg)
                            <option value="{{ $reg->id }}" {{ old('region', $shop->contactInfo->street->town->region->id ?? null) == $reg->id ? 'selected' : '' }}>{{  $reg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="town" class="form-control" id="town_selection" oninput="loadStreets(event)" required>
                        <option>Town</option>
                        @foreach ($towns as $tn)
                            <option value="{{ $tn->id }}" {{ old('town', $shop->contactInfo->street->town->id) == $tn->id ? 'selected' : '' }}>{{ $tn->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="street" class="form-control" id="street_selection">
                        <option>Street</option>
                        @foreach ($streets as $st)
                            <option value="{{ $st->id }}" {{ old('street', $shop->contactInfo->street_id) == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 px-2 py-2">
                    <input type="text" name="address" class="form-control" value="{{ old('website', $shop->contactInfo->website) }}" placeholder="Business address">
                </div>
                
                <div class=" py-2 theme-form-floating">
                    <span class="text-capitalize">Phone number</span>
                    <div class="d-flex">
                        <div class="w-50 position-relative">
                            <span class="position-absolute fa-2x m-2 fa fa-phone"></span>
                            <select class="form-control input-sm" style="padding-left: 3.5rem;" name="phone_country_code" required>
                                <option>Country</option>
                                @foreach (config('country-phone-codes') as $phcode)
                                    <option value="{{ $phcode['code'] }}" {{ old('phone_country_code', $shop->contactInfo->phone_country_code) == $phcode['code'] ? 'selected' : '' }}>{{ $phcode['country'] }} ( {{ $phcode['code'] }} )</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-50">
                            <input type="tel" class="form-control input-sm" name="phone" required value="{{ old('phone', $shop->contactInfo->phone) }}">
                        </div>
                    </div>
                </div>
                <div class=" py-2 theme-form-floating">
                    <span class="text-capitalize">Whatsapp number</span>
                    <div class="d-flex">
                        <div class="w-50 position-relative">
                            <span class="position-absolute fa-2x m-2 fa fa-whatsapp"></span>
                            <select class="form-control input-sm" style="padding-left: 3.5rem;" name="whatsapp_country_code" required>
                                <option>Country</option>
                                @foreach (config('country-phone-codes') as $phcode)
                                    <option value="{{ $phcode['code'] }}" {{ old('whatsapp_country_code', $shop->contactInfo->whatsapp_country_code) == $phcode['code'] ? 'selected' : '' }}>{{ $phcode['country'] }} ( {{ $phcode['code'] }} )</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-50">
                            <input type="tel" class="form-control input-sm" name="whatsapp" required value="{{ old('whatsapp', $shop->contactInfo->whatsapp) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="email" name="email" class="form-control" value="{{ old('email', $shop->contactInfo->email??'') }}" placeholder="Business Email">
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="url" name="website" class="form-control" value="{{ old('website', $shop->contactInfo->website) }}" placeholder="Business website">
                </div>
            </div>
        </div>

        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="px-2 py-2 mx-4 flex">
                Status: 
                <span class="mx-4"><input type="radio" name="is_branch" {{ $shop->is_branch == 0 ? 'checked' : '' }} checked value="0" class="mx-3" required>Head Office</span>
                <span class="mx-4"><input type="radio" name="is_branch" {{ $shop->is_branch == 1 ? 'checked' : '' }} checked value="1" class="mx-3" required>Branch</span>
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
                let route = "{{ route('region.towns', '__ID__') }}".replace('__ID__', region);
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
                let route = "{{ route('town.streets', '__ID__') }}".replace('__ID__', town);
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