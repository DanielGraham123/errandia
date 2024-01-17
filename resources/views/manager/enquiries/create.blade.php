@extends('manager.layout')
@section('section')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 px-2">
                <div class="container-fluid">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="m-2 rounded bg-white p-3" style="height: 10rem; width: 10rem;">
                            <img class="img-responsive w-100 h-100" src="{{ asset('assets/images/background1.png') }}">
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-md-9 col-lg-9 px-2">
                <div class="card d-flex">
                    <div class="p-4 bg-white rounded-md border card-img-left col-sm-5">
                        <img class="img-responsive w-100 h-100 rounded border" src="{{ asset('assets/images/background1.png') }}">
                    </div>
                    <div class="card-body">
                        <div class="py-4">
                            <span class="d-block text-body-sm">Barber Shop</span>
                            <span class="d-block text-h6">Slick Gorilla Clay Pomade 70 gm</span>
                            <span class="d-block" style="font-size: 2rem; font-weight: 700;">XAF 10,000</span>
                        </div>
                        <p class="card-text text-body">
                            Repellendus porro aperiam sint ut. Quo est voluptatem
                            consequatur. Repellat sunt sint aut quaerat. Aut sit qui. Impedit
                            quia earum molestias. Laboriosam est repellat ut ratione distinctio
                            placeat nulla. Doloremque odit earum explicabo harum totam
                            magni.
                        </p>
                        <div class="py-4">
                            <a class="button-primary" href=""><span class="fa fa-whatsapp mr-2"></span>Chat on Whatsapp</a>
                            <a class="button-secondary" href=""><span class="fa fa-phone mr-2"></span>Call 673580194</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-5 bg-white py-3 px-4" style="border-radius: 0.7rem;">
            <div class="d-flex flex-wrap justify-content-center mb-5 border-bottom">
                <span class="py-2 px-5"><a class="text-link" href="#">Description</a></span>
                <span class="py-2 px-5"><a class="text-link" href="#">Supplier Info</a></span>
                <span class="py-2 px-5"><a class="text-link" href="#">Send Enquiry</a></span>
                <span class="py-2 px-5"><a class="text-link" href="#">Supplier's Reviews (8)</a></span>
            </div>
            <span class="d-block text-h6">Make an Enquiry</span>
            <form class="post" enctype="multipart/form-data">
                @csrf
                <span class="d-block text-body">If you have a picture to upload to give a better description of your enquiry, kindly attach them below</span>
                <input class="form-control rounded" type="file" name="image">
                <input class="form-control rounded" type="text" name="title" placeholder="Title">
                <textarea class="form-control rounded" name="description" rows="4">Description<textarea>
            </form>
        </div>
    </div>
@endsection