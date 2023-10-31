@extends('b_admin.layout')
@section('section')
    <div class="container">
        <div class="py-3 my-2 px-2">
            <span class="text-h4 d-block">Edit Errand </span>
            <span class="text-overline d-block">Run a custom product search errand to instantly reach suppliers </span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">

                <span class="d-block mt-4" style="font-weight: 700;">What do you want to find?*</span>
                <input class="my-2 form-control rounded" name="title" type="text" required value="{{ old('title') }}" placeholder="search title">
                
                
                <span class="d-block mt-4" style="font-weight: 700;">Specify search location*</span>
                <div class="row">
                    <div class="col-md-4 py-2">
                        <select name="region" class="form-control rounded" oninput="loadTowns(event)" required>
                            <option>Region</option>
                            @foreach ($regions as $reg)
                                <option value="{{ $reg->id }}" {{ old('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 py-2">
                        <select name="town" class="form-control rounded" id="town_selection" oninput="loadStreets(event)" required>
                            <option></option>
                            @foreach ($towns as $tn)
                                <option value="{{ $tn->id }}" {{ old('town') == $tn->id ? 'selected' : '' }}>{{ $tn->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 py-2">
                        <select name="street" class="form-control rounded" id="street_selection" required>
                            <option></option>
                            @foreach ($streets as $st)
                                <option value="{{ $st->id }}" {{ old('street') == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <span class="d-block mt-4" style="font-weight: 700;">Description</span>
                <textarea class="form-control rounded" name="description" rows='4' required>{{ old('description', 'Description') }}</textarea>
                
                <span class="d-block mt-4" style="font-weight: 700;">Product image gallery*</span>
                <div class="my-3 border-left border-right rounded multipleImageUplaoder">
                </div>

                <span class="d-block mt-4" style="font-weight: 700;">Categories *</span>
                <div class="d-flex flex-wrap my-3 border-left border-right rounded">
                    @foreach ($categories as $cat)
                        <span class="d-inlineblock rounded border bg-light py-1 px-3 my-2 mx-2">
                            <input type="checkbox" class="input mx-2" name="categories[]" value="{{ $cat->id }}">
                            <span class="text-extra">{{ $cat->name }}</span>
                        </span>
                    @endforeach
                </div>
                
            </div>
            <span class="d-flex justify-content-end my-4"><button class="button-primary" type="submit">Update</button></span>
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

                let _id = ((Math.random()*100000000)+Date.now()+crypto.randomUUID()).replace('.', '');
        let set_id = function(){
            _id = ((Math.random()*100000000)+Date.now()+crypto.randomUUID()).replace('.', '');
        }
        let get_id = function(){
            return _id;
        }

        $(document).ready(function(){
            init();
        });
        
        let init = function(){
            $('.multipleImageUplaoder').each((index, elem)=>{
                let ___trigger = `<div class="d-flex flex-wrap multipleImageContainer py-3"></div>
                    <div style="width: 0; height: 0; overflow: hidden;" class="imageFieldsContainer">
                        <input type="file" name="gallery[]", accept="image/*" id="${get_id()}" onchange="preview('${get_id()}', '${index}')">
                    </div>
                    <div class="py-3 px-3">
                        <a title="add image" onclick="addImage(${index})"><span class="fa fa-plus fa-4x border rounded p-4 text-primary bg-light"></span></a>
                    </div>`;
                $(elem).append(___trigger);
            })
        }
        let refresh = function(index){
            let field = `<input type="file" name="gallery[]", accept="image/*" id="${get_id()}" onchange="preview('${get_id()}', '${index}')">`;
            let container = $('.multipleImageUplaoder').get(index).children.item(1);
            $(container).append(field);
        }

        let addImage = function(index){
            $("#"+_id).click();
            // let field = `<input type="file" name="gallery[]", accept="image/*" id="${get_id()}" onchange="preview('${get_id()}', '${index}')">`;
        }
        
        let preview = function(field_id, index){
            let file = document.getElementById(field_id).files[0];
            let url = URL.createObjectURL(file);
            let image = `<img class="mx-2 my-2" style="width: 12rem; height: 12rem; border-radius: 0.6rem;" src="${url}">`;
            let container = $('.multipleImageUplaoder').get(index).children.item(0);
            $(container).append(image);
            set_id();
            refresh(index);
        }
    </script>
@endsection