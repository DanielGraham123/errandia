@extends('b_admin.layout')
@section('section')
    <div class="container">
        <div class="d-flex py-3 my-2 px-2">
            <span class="text-h4 d-block">Products For {{ $shop->name }} <i class="text-extra">({{ $shop->location() }})</i></span>
        </div>
        <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">
            <span class="d-block mt-4" style="font-weight: 700;">Product Name *</span>
            <input class="my-2 form-control rounded" name="name" type="text" value="{{ old('name') }}" placeholder="Product Name">
            <select class="my-2 form-control rounded" name="sub_category_id">
                <option>Select Category*</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('sub_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
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
            <textarea class="form-control rounded" name="description" rows='4'>{{ old('description', 'Description') }}</textarea>
            <span class="d-block mt-4" style="font-weight: 700;">Upload Default image *</span>
            <input type="file" accept="image/*" class="form-control rounded" name="image">
            <span class="d-block text-overline" style="font-weight: 700;">This appear as the main image on the website</span>
            <span class="d-block mt-4" style="font-weight: 700;">Product Image Gallery *</span>
            <div></div>
            <span class="d-block mt-4" style="font-weight: 700;">Product Tags</span>
            <input class="form-control rounded" name="tags" value="{{ old('tags') }}" placeholder="tags">
            <span class="d-block text-overline" style="font-weight: 700;">Enter terms related to your product</span>
        </div>
            <span class="d-block my-4"><button class="button-primary" type="submit">Add Product</button></span>
    </div>
@endsection