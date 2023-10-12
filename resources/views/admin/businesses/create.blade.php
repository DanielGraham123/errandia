@extends('admin.layout')
@section('section')
<form>
    <div>
        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Business details</div>
            <div class="row mx-5 my-2">
                <div class="col-md-12 px-2 py-2">
                    <input type="text" name="business_name" class="form-control" placeholder="Business Name">
                </div>
                <div class="col-md-12 px-2 py-2">
                    <input type="file" name="business_logo" class="form-control" placeholder="Business Name">
                </div>
                <div class="col-md-12 px-2 py-2">
                    <textarea name="business_description" class="form-control" rows="4">Description</textarea>
                </div>
                <div class="col-md-4 py-2 px-0">
                    <select name="business_region" class="form-control">
                        <option>Region</option>
                    </select>
                </div>
                <div class="col-md-4 py-2">
                    <select name="business_town" class="form-control">
                        <option>Town</option>
                    </select>
                </div>
                <div class="col-md-4 py-2 px-0">
                    <select name="business_street" class="form-control">
                        <option>Street</option>
                    </select>
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="tel" name="business_phone" class="form-control input-flied telephone" placeholder="Business Phone">
                </div>
                <div class="col-md-6 px-2 py-2">
                    <input type="email" name="business_email" class="form-control" placeholder="Business Email">
                </div>
                <div class="col-md-12 px-2 py-2">
                    <input type="url" name="business_website" class="form-control" placeholder="Business website">
                </div>
                <div class="col-md-12 px-2 py-2 flex">
                    Business Type: 
                    <span class="mx-4"><input type="radio" name="business_type" checked value="business" class="mx-3" required>Business</span>
                    <span class="mx-4"><input type="radio" name="business_type" value="service" class="mx-3" required>Service</span>
                </div>
            </div>
        </div>

        <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
            <div class="text-h4 text-center text-uppercase my-3">Verification</div>
            <div class="px-2 py-2 mx-4 flex">
                Verification Status: 
                <span class="mx-4"><input type="radio" name="verification_status" value="verified" class="mx-3" required>verified</span>
                <span class="mx-4"><input type="radio" name="verification_status" checked value="unverified" class="mx-3" required>unverified</span>
            </div>
        </div>
        <div class="py-2">
            <button href="#" class="button-primary btn-lg">Add Business</button>
        </div>
    </div>
</form>
@endsection