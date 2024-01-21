@extends('admin.layout')
@section('section')
<form method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Business details</div>
            <div class="row mx-5 my-2">
                <div class="col-md-12 px-2 py-2">
                    <input type="text" name="name" class="form-control" placeholder="Business Name" value="{{ $business->name }}">
                </div>
                <div class="col-md-12 px-2 py-2">
                    <select name="category" class="form-control" placeholder="">
                        <option>Business categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $business->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 px-2 py-2">
                    <input type="file" name="logo" class="form-control" placeholder="Business Name">
                </div>
                <div class="col-md-12 px-2 py-2">
                    <textarea name="description" class="form-control" rows="4">{{ $business->description }}</textarea>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="region" class="form-control" oninput="loadTowns(event)" required>
                        <option>Region</option>
                        @foreach ($regions as $reg)
                            <option value="{{ $reg->id }}" {{ $reg->id == $business->region_id ? 'selected' : '' }}>{{ $reg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="town" class="form-control" id="town_selection" oninput="loadStreets(event)" required>
                        <option>Town</option>
                        @foreach ($towns as $tn)
                            <option value="{{ $tn->id }}" {{ $tn->id == $business->town_id ? 'selected' : '' }}>{{ $tn->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 py-2 px-2">
                    <select name="street" class="form-control" id="street_selection">
                        <option>Street</option>
                        @foreach ($streets as $st)
                            <option value="{{ $st->id }}" {{ $st->id == $business->street_id ? 'selected' : '' }}>{{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <div class="input-group">
                        <span class="input-group-addon fa fa-phone text-h6"></span>
                        {{-- <select class="form-control" name="phone_code">
                            @foreach (config('country-phone-codes') as $phcode)
                                <option value="+{{ $phcode['code'] }}">{{ $phcode['country'] }} (+{{ $phcode['code'] }})</option>
                            @endforeach
                        </select> --}}
                        <input class="form-control" name="phone" type="tel" value="{{ $business->phone }}" required />
                    </div>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <div class="input-group">
                        <span class="input-group-addon fa fa-whatsapp text-h6"></span>
                        {{-- <select class="form-control" name="whatsapp_phone_code">
                            @foreach (config('country-phone-codes') as $phcode)
                                <option value="+{{ $phcode['code'] }}">{{ $phcode['country'] }} (+{{ $phcode['code'] }})</option>
                            @endforeach
                        </select> --}}
                        <input class="form-control" name="whatsapp_phone" value="{{ $business->whatsapp_phone }}" type="tel" placeholder="Whatstapp phone number" />
                    </div>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="email" name="email" class="form-control" placeholder="Business Email" value="{{ $business->email }}">
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="url" name="website" class="form-control" placeholder="Business website" value="{{ $business->website }}">
                </div>
                <div class="col-md-12 px-2 py-2 flex">
                    Business Type: 
                    <span class="mx-4"><input type="radio" name="business_type" value="business" {{ $business->type == 'business' ? 'checked' : '' }} class="mx-3" required>Business</span>
                    <span class="mx-4"><input type="radio" name="business_type" value="service" {{ $business->type == 'service' ? 'checked' : '' }} class="mx-3" required>Service</span>
                </div>
            </div>
        </div>

        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Verification</div>
            <div class="px-2 py-2 mx-4 flex">
                Verification Status: 
                <span class="mx-4"><input type="radio" name="verification_status" value="1" {{ $business->status == 1 ? 'checked' : '' }} class="mx-3" required>verified</span>
                <span class="mx-4"><input type="radio" name="verification_status" value="0" {{ $business->status == 0 ? 'checked' : '' }} class="mx-3" required>unverified</span>
            </div>
        </div>
        <div class="py-2">
            <button href="#" class="button-primary btn-lg">Update</button>
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