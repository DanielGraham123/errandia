@extends('b_admin.c_layout')
@section('section')
@php
    $_step = $step ?? 1
@endphp
    <div class="container">
        <div class="table-header">
            Edit Product
        </div>
        
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @switch($_step)
                @case(1)
                    <input type="hidden" name="step" value="1">
                    <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">
                        <span class="d-block mt-4" style="font-weight: 700;">Product Name *</span>
                        <input  data-max-words="6" data-announce="true" class="my-2 form-control rounded" name="name" type="text" required value="{{ old('name', $product->name) }}" placeholder="Product Name">
                        <span class="d-block mt-4" style="font-weight: 700;">Product Tags <span class="text-info">(related names separated by commas)</span></span>
                        <input class="form-control rounded" name="tags" value="{{ old('tags', $product->tags) }}" placeholder="tags" required>
                        <span class="d-block text-overline" style="font-weight: 700;">Enter terms related to your product</span>
                        <span class="d-block mt-4" style="font-weight: 700;">Upload Default image *</span>
                        <div class="d-flex flex-wrap justify-content-between" id="defaultImageContainer">
                            <div class="d-inlineblock">
                                <input type="file" accept="image/*" class="form-control rounded" name="image" onchange="defaultPreview(event)">
                                <span class="d-block text-overline" style="font-weight: 700;">This appear as the main image on the website</span>
                            </div>
                            <span class="image-box">
                                <img style="width: 12rem; 
                                height: 12rem; border-radius: 0.6rem;" src="{{ asset('uploads/item_images/'.$product->featured_image) }}">
                            </span>
                        </div>
                    </div>
                    <span class="d-block my-4"><button class="button-primary" type="submit">NEXT</button></span>
                    @break
                @case(2)
                    <input type="hidden" name="step" value="2">
                    <input type="hidden" name="item_slug" value="{{ $item->slug }}">
                    
                    <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">
                        <span class="d-block mt-4" style="font-weight: 700;">Product Name *</span>
                        <input class="my-2 form-control rounded" name="name" readonly type="text" required value="{{ old('name', $item->name??'') }}" placeholder="Product Name">
                        <span class="d-block mt-4" style="font-weight: 700;">Product Tags <span class="text-info">(related names separated by commas)</span></span>
                        <input class="form-control rounded" name="tags" readonly value="{{ old('tags', $item->tags??'') }}" placeholder="tags" required>
                        <span class="d-block text-overline" style="font-weight: 700;">Enter terms related to your product</span>
                        <span class="d-block mt-4" style="font-weight: 700;">Default image *</span>
                        <div class="d-flex flex-wrap justify-content-between" id="defaultImageContainer">
                            <div class="d-inlineblock">
                                <img class="img img-rounded img-responsive" src="{{ asset('uploads/item_images/'.$item->featured_image) }}" style="width: 9rem; height: 9rem; border-radius: 0.4rem;">
                            </div>
                        </div>
                        <hr>
                        <span class="d-block mt-4" style="font-weight: 700;">Categories *</span>
                        <div class="d-flex flex-wrap my-3 border-left border-right rounded">
                            @foreach ($categories as $cat)
                                <span class="d-inlineblock rounded-sm border bg-light py-1 px-3 my-2 mx-2">
                                    <input type="checkbox" class="input mx-2" name="categories[]" {{ in_array($cat, $proposed_categories) ? 'checked' : '' }} value="{{ $cat->id }}">
                                    <span class="text-extra">{{ $cat->name }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <span class="d-block my-4"><button class="button-primary" type="submit">NEXT</button></span>
                    @break
                @case(3)
                    <input type="hidden" name="step" value="3">
                    <input type="hidden" name="item_slug" value="{{ $item->slug }}">
                    <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">

                        <span class="d-block mt-4" style="font-weight: 700;">Product Name *</span>
                        <input class="my-2 form-control rounded" name="name" readonly type="text" required value="{{ old('name', $item->name??'') }}" placeholder="Product Name">
                        <span class="d-block mt-4" style="font-weight: 700;">Product Tags <span class="text-info">(related names separated by commas)</span></span>
                        <input class="form-control rounded" name="tags" readonly value="{{ old('tags', $item->tags??'') }}" placeholder="tags" required>
                        <span class="d-block text-overline" style="font-weight: 700;">Enter terms related to your product</span>
                        <span class="d-block mt-4" style="font-weight: 700;">Default image *</span>
                        <div class="d-flex flex-wrap justify-content-between" id="defaultImageContainer">
                            <div class="d-inlineblock">
                                <img class="img img-rounded img-responsive" src="{{ asset('uploads/item_images/'.$item->featured_image)  }}" style="width: 9rem; height: 9rem; border-radius: 0.4rem;">
                            </div>
                        </div>
                        <hr>

                        <span class="d-block mt-4" style="font-weight: 700;">Categories *</span>
                        <div class="d-flex flex-wrap my-3 border-left border-right rounded">
                            @foreach (\App\Models\SubCategory::orderBy('name')->get() as $cat)
                                <span class="d-inlineblock rounded border py-1 px-3 my-2 mx-2 {{ in_array($cat->id, $item->subCategories->pluck('id')->toArray()) ? 'border-danger bg-danger' : 'border-secondary bg-light' }}">
                                    <input type="checkbox" disabled class="input mx-2" name="categories[]" {{ in_array($cat->id, $item->subCategories->pluck('id')->toArray()) ? 'checked' : '' }} value="{{ $cat->id }}">
                                    <span class="text-extra">{{ $cat->name }}</span>
                                </span>
                            @endforeach
                        </div>
                        <hr>

                        <span class="d-block mt-4" style="font-weight: 700;">Product image gallery*</span>
                        {{-- <div class="my-3 border-left border-right rounded multipleImageUplaoder"></div> --}}
                        {{-- <span class="d-block mt-4" style="font-weight: 700;">Product images</span>
                        <input class="form-control rounded" type="file" multiple accept="image/*" name="images" value="{{ old('images') }}" placeholder="other images" oninput="imageChanged(event)"> --}}
                        <div id="product_image_preview_box" class="d-flex"></div>
                        <span class="d-block mt-4" style="font-weight: 700;">Unit price *</span>
                        <input class="form-control rounded" name="unit_price" value="{{ old('unit_price', $product->unit_price ?? '') }}" placeholder="unit price" required>
                        <span class="d-block mt-4" style="font-weight: 700;">Description *</span>
                        <textarea class="form-control rounded" rows="3" name="description" value="" placeholder="description" required>{{ old('description', $product->description??'') }}</textarea>
                    </div>
                    <span class="d-block my-4"><button class="button-primary" type="submit">PUBLISH</button></span>
                    @break
            @endswitch
        </form>
    </div>

@endsection
@section('script')
    <script>
        let defaultPreview = function(event){
            let files = event.target.files[0];
            let url = URL.createObjectURL(files);
            let prevw = `<img style="width: 12rem; height: 12rem; border-radius: 0.6rem;" src="${url}">`;
            $('#defaultImageContainer > .image-box').html(prevw);
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
            let image = `<div id="preview_${get_id()}">
                    <img class="mx-2 my-2" style="width: 12rem; height: 12rem; border-radius: 0.6rem;" src="${url}">
                    <span class=" text-danger text-center d-block py-1 px-2 my-1 rounded bg-light border" onclick="dropImage('${get_id()}', event)">drop</span>
                </div>`;
            let container = $('.multipleImageUplaoder').get(index).children.item(0);
            $(container).append(image);
            set_id();
            refresh(index);
        }

        let dropImage = function(_input_id){
            $(document).remove('#'+_input_id); // drop image input file
            $(document).remove('#preview_'+_input_id); // drop image preview
        }

        let imageChanged = function(event){
            
            var _files = event.target.files;

            if (parseInt(_files.length)>3){
                alert("You can only upload a maximum of 3 files");
                $(event.target).val(null);
                return;
            }
            let html = ``;
            // console.log(typeof _files);
            for (const key in _files) {
                if (Object.hasOwnProperty.call(_files, key)) {
                    const element = _files[key];
                    let _url = URL.createObjectURL(element);
                    html += `<img src="${_url}" style="width: 5rem; height: 5rem; border: 1px solid black; border-radius: 0.4rem; margin: 0.3rem 0.2rem;">`;
                }
            }
            $('#product_image_preview_box').html(html);
            
        }
    </script>
@endsection