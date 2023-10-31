@extends('b_admin.layout')
@section('section')
    <div class="container">
        <span class="d-block my-3 text-h6">Errand Details</span>
        <div class="d-flex flex-wrap">
            <div class="col-md-6">
                <div class="border bg-white shadow-md p-5 m-3" style="border-radius: 0.6rem;">
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Title</span>
                        <span class="col-sm-9 text-h6 text-capitalize">{{ $errand->title??'' }}</span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Description</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->description??'' }}</span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">categories</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->_categories()->first()->name??'' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="border bg-white shadow-md p-5 m-3" style="border-radius: 0.6rem;">
                    <span class="h5" style="color: var(--color-darkblue);">Posted By</span>
                    <span class="d-block"><img style="width: 6rem; height 6rem; border-radius: 50%; border: 1px solid var(--color-darkblue);" src="{{ asset('assets/admin/images/admin-profile-pic.png') }}"> <span class="text-overline ml-3">{{ $errand->posted_by->name??'user' }}</span></span>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">phone</span>
                        <span class="col-sm-9 text-body text-capitalize">
                            {{ $errand->posted_by->phone??'' }} 
                            <a class="bg-light rounded px-2 py-1 text-body-sm"><span class=" fa fa-phone mx-auto"></span>Call</a> 
                            <a class="bg-light rounded px-2 py-1 text-body-sm"><span class=" fa fa-whatsapp mx-auto"></span>Contact via Whatsapp</a> 
                        </span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Email</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->posted_by->email??'' }} 
                            <a class="bg-light rounded px-2 py-1 text-body-sm"><span class=" fab fa-message mx-2"></span>Call</a> 
                        </span>
                    </div>
                    <div class="row my-3">
                        <span class="col-sm-3 text-extra text-capitalize">Location</span>
                        <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->location()??'' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection