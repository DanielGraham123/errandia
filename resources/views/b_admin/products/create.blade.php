@extends('b_admin.layout')
@section('section')
    <div class="container">
        <div class="d-flex py-3 my-2 px-2">
            <span class="text-h4 d-block">Add New Product For {{ $shop->name }} <i class="text-link">({{ $shop->location() }})</i></span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">
                <span class="d-block mt-4" style="font-weight: 700;">Product Name *</span>
                <input class="my-2 form-control rounded" name="name" type="text" required value="{{ old('name') }}" placeholder="Product Name">
                <span class="d-block mt-4" style="font-weight: 700;">Unit Price *</span>
                <div class="input-group border rounded">
                    <select class="form-control w-25 rounded-left border-0" name="currency">
                        <option></option>
                        @foreach ($currencies as $cur)
                            <option value="{{ $cur->name }}" {{ $cur->name == 'XAF' ? 'selected' : '' }}>{{ $cur->name }}</option>
                        @endforeach
                    </select>
                    <input class="form-control border-0 rounded-right" name="price" value="{{ old('price') }}" placeholder="price">
                </div>
                <span class="d-block mt-4" style="font-weight: 700;">Description</span>
                <textarea class="form-control rounded" name="description" rows='4' required>{{ old('description', 'Description') }}</textarea>
                <span class="d-block mt-4" style="font-weight: 700;">Product Tags</span>
                <input class="form-control rounded" name="tags" value="{{ old('tags') }}" placeholder="tags" required>
                <span class="d-block text-overline" style="font-weight: 700;">Enter tags related to your product</span>
                <span class="d-block mt-4" style="font-weight: 700;">Upload Default image *</span>
                <div class="d-flex flex-wrap justify-content-between" id="defaultImageContainer">
                    <div class="d-inlineblock">
                        <input type="file" accept="image/*" class="form-control rounded" name="image" onchange="defaultPreview(event)" required>
                        <span class="d-block text-overline" style="font-weight: 700;">This appear as the main image on the website</span>
                    </div>
                </div>
            </div>
            <span class="d-block my-4"><button class="button-primary submit-btn" type="submit">NEXT</button></span>
        </form>
    </div>
@endsection
@section('script')
    <script>
        let defaultPreview = function(event){
            let files = event.target.files[0];
            let url = URL.createObjectURL(files);
            let prevw = `<img style="width: 12rem; height: 12rem; border-radius: 0.6rem;" src="${url}">`;
            $('#defaultImageContainer').append(prevw);
        }
    </script>
@endsection