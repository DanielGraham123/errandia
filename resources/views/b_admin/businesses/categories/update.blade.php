@extends('b_admin.layout')
@section('section')
    <div class="py-3">
        <div class="my-4 card">
            <div class="card-body">
                <h3 class="text-secondary fw-bold my-3">Update Business Categories</h3>
                <form method="POST">
                    @csrf
                    <div class="py-2">
                        <label class="text-info text-capitalize">categories</label>
                        <hr>
                        <div class="row">
                            @foreach ($scats as $scat)
                                <span class="py-1 px-2 text-secondary col-sm-6 col-lg-4 col-xxl-3 col-xxl-2">
                                    <input type="checkbox" name="sub_categories[]" value="{{ $scat->id }}" {{ in_array($scat->id, $biz_cats) ? 'checked' : '' }} class="mr-2">
                                    {{ $scat->name }}
                                </span>
                            @endforeach
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end py-2">
                            <button class="button-secondary text-capitalize" type="submit">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection