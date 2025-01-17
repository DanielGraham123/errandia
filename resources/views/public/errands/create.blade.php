@extends('public.layout')
@section('section')
    @if(!(auth()->check()))
        <div class="card">
            <div class="text-center py-4 col-md-5 col-lg-4 mx-auto card-body py-5">
                <a class="button-primary mb-5" href="{{ route('login') }}">Login to runn errand</a><hr class="d-block">
                <span class="text-extra">Don't have an account? <a href="{{ route('register') }}" class="button-secondary">create and account</a></span>
            </div>
        </div>
    @else
        <div class="container">
            <div class="py-3 my-2 px-2">
                <span class="text-h4 d-block">Post New Errand </span>
                <span class="text-overline d-block">Run a custom product search errand to instantly reach suppliers </span>
            </div>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">

                    <div class="d-flex justify-content-center">
                        <span class="d-block"><span class=" badge-lg d-block p-5 border" style="background: #4d9eba">1</span>search details</span>
                        <span class="fa fa-arrow-right fa-2x text-primary mx-5 px-5 py-5"></span>
                        <span class="d-block"><span class="badge-light badge-lg d-block p-5 border">2</span>upload photos</span>
                    </div>
                    <span class="d-block mt-4" style="font-weight: 700;">What do you want to find?*</span>
                    <input class="my-2 form-control rounded" name="title" type="text" required value="{{ old('title') }}" placeholder="search title">
                    
                    
                    <span class="d-block mt-4" style="font-weight: 700;">Specify search location</span>
                    <div class="row">
                        <div class="col-md-4 py-2">
                            <select name="region" class="form-control rounded" oninput="loadTowns(event)">
                                <option>General</option>
                                @foreach ($regions as $reg)
                                    <option value="{{ $reg->id }}" {{ old('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 py-2">
                            <select name="town" class="form-control rounded" id="town_selection" oninput="loadStreets(event)">
                                <option></option>
                                @foreach ($towns as $tn)
                                    <option value="{{ $tn->id }}" {{ old('town') == $tn->id ? 'selected' : '' }}>{{ $tn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 py-2">
                            <select name="street" class="form-control rounded" id="street_selection">
                                <option></option>
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
    @endif
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