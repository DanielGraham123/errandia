@extends('b_admin.layout')
@section('section')
    <div class="container">
        <div class="py-3 my-2 px-2">
            <span class="text-h4 d-block">Post New Errand </span>
            <span class="text-overline d-block">Run a custom product search errand to instantly reach suppliers </span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">

                <div class="d-flex justify-content-center">
                    <span class="d-block"><span class="badge badge-primary badge-lg d-block p-5 border">1</span>search details</span>
                    <span class="fa fa-arrow-right fa-2x text-primary mx-5 px-5 py-5"></span>
                    <span class="d-block"><span class="badge badge-light badge-lg d-block p-5 border">2</span>upload photos</span>
                </div>
                <span class="d-block mt-4" style="font-weight: 700;">What do you want to find?  <span class="text-danger">Product name only (eg. charger, laptop, battery)*</span></span>
                <input class="my-2 form-control rounded" name="title" type="text" required value="{{ old('title') }}" placeholder="search title">
                
                
                <span class="d-block mt-4" style="font-weight: 700;">Specify search location</span>
                <div class="row">
                    <div class="col-md-4 py-2">
                        <select name="region" class="form-control rounded" oninput="loadTowns(event)">
                            <option>All Regions</option>
                            @foreach ($regions as $reg)
                                <option value="{{ $reg->id }}" {{ old('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 py-2">
                        <select name="town" class="form-control rounded" id="town_selection" oninput="loadStreets(event)">
                            <option>All Towns</option>
                            @foreach ($towns as $tn)
                                <option value="{{ $tn->id }}" {{ old('town') == $tn->id ? 'selected' : '' }}>{{ $tn->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 py-2">
                        <select name="street" class="form-control rounded" id="street_selection">
                            <option>All Streets</option>
                            @foreach ($streets as $st)
                                <option value="{{ $st->id }}" {{ old('street') == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <span class="d-block mt-4" style="font-weight: 700;">Description</span>
                <textarea class="form-control rounded" name="description" rows='4' required>{{ old('description', 'Description') }}</textarea>
                
            </div>
            <span class="d-flex justify-content-end my-4"><button class="button-primary" type="submit">Proceed</button></span>
        </form>
    </div>
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