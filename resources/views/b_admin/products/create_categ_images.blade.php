@extends('b_admin.layout')
@section('section')
    <div class="container">
        <div class="d-flex py-3 my-2 px-2">
            <span class="text-h4 d-block">Add New Product For {{ $shop->name }} <i class="text-link">({{ $shop->location() }})</i></span>
        </div>
        <form method="POST" id="form" action="{{ route('business_admin.products.create_update', ['product' => $product]) }}" enctype="multipart/form-data">
            @csrf
            <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">
                <span class="d-block mt-4" style="font-weight: 700;">Categories *</span>
                <div class="d-flex flex-wrap my-3 border-left border-right rounded">
                    @foreach ($categories as $cat)
                        <span class="d-inlineblock rounded border bg-light py-1 px-3 my-2 mx-2">
                            <input type="checkbox" class="input mx-2" name="categories[]" {{ in_array($cat, $proposed_categories) ? 'checked' : '' }} value="{{ $cat->id }}">
                            <span class="text-extra">{{ $cat->name }}</span>
                        </span>
                    @endforeach
                </div>
                <span class="d-block mt-4" style="font-weight: 700;">Product image gallery*</span>
                <div class="my-3 border-left border-right rounded multipleImageUplaoder">
                </div>
            </div>
            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                         role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
            <span class="d-block my-4"><button class="button-primary" type="submit">Finish</button></span>
        </form>
    </div>
@endsection
@section('script')
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
        const test = {!! $product !!};


        let init = function(){
            $('.multipleImageUplaoder').each((index, elem)=>{
                let ___trigger = `<div class="d-flex flex-wrap multipleImageContainer py-3"></div>
                    <div style="width: 0; height: 0; overflow: hidden;" class="imageFieldsContainer">
                        <input type="file" name="gallery[]", accept="image/*" id="${get_id()}" onchange="preview('${get_id()}', '${index}', this)">
                    </div>
                    <div class="py-3 px-3">
                        <a title="add image" onclick="addImage(${index})"><span class="fa fa-plus fa-4x border rounded p-4 text-primary bg-light"></span></a>
                    </div>`;
                $(elem).append(___trigger);
            })
        }
        let refresh = function(index){
            let field = `<input type="file" name="gallery[]", accept="image/*" id="${get_id()}" onchange="preview('${get_id()}', '${index}', this)">`;
            let container = $('.multipleImageUplaoder').get(index).children.item(1);
            $(container).append(field);
        }

        let addImage = function(index){
            $("#"+_id).click();
            // let field = `<input type="file" name="gallery[]", accept="image/*" id="${get_id()}" onchange="preview('${get_id()}', '${index}')">`;
        }

        let preview = function(field_id, index, ele){
            let file = document.getElementById(field_id);
            let url = URL.createObjectURL(file.files[0]);
            uploadImage(ele);
            let image = `<div class="preview-image">
                    <img class="mx-2 my-2" style="width: 12rem; height: 12rem; border-radius: 0.6rem;" src="${url}">
                    <span class="fa fa-close text-danger text-center d-block py-1 px-2 my-1 rounded bg-light border" onclick="dropImage(this, '${field_id}', '${ele}' )"></span>
                </div>`;
            let container = $('.multipleImageUplaoder').get(index).children.item(0);
            $(container).append(image);
            set_id();
            refresh(index);
        }

        let dropImage = function(image, data, ele){
             var formData = new FormData();
            formData.append('image', document.getElementById(data).files[0]);
            let percentage = '0';
            $.ajax({
                type:'DELETE',
                url: "/api/remove_image/"+test.id,
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage+'%', function() {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                success: (res) => {
                    $('.preview-image').html('')
                },
                error: function(data){
                }
            });

        }

        function  uploadImage(obj){
            var formData = new FormData()
            formData.append('image',obj.files[0]);
            let percentage = '0';
            $.ajax({
                type:'POST',
                url: "/api/save_images/"+test.id,
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage+'%', function() {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                success: (res) => {
                },
                error: function(data){
                }
            });
        }


    </script>
@endsection