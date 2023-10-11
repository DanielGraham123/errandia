@extends('admin.layout')
@section('section')
    <div class="py-2 row">
        <div class="col-lg-6 px-2 py-2">
            <div class="rounded-md shadow py-4 px-5 bg-white">
                <div class="text-h6 text-uppercase my-3">service details</div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">product name</div>
                    <div class="col-md-9 text-body ">Advanced Snail Mucin power essence</div>
                </div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">Categories</div>
                    <div class="col-md-9 text-body "><span class="mx-3">Beauty</span>,<span class="mx-3">Skin care</span></div>
                </div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">description</div>
                    <div class="col-md-9 text-body ">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui eos tempore dolores commodi praesentium laudantium, unde inventore quaerat iure sapiente nulla nesciunt nobis! Eos magni ratione unde laudantium ipsa exercitationem!
                    Sunt consequatur adipisci libero incidunt blanditiis ipsam ducimus placeat earum, cum, animi laboriosam atque repellendus non. Ducimus asperiores unde dolor tempora, ex aspernatur odit neque pariatur. Quidem minima dolor praesentium.</div>
                </div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">created on</div>
                    <div class="col-md-9 text-body ">{{ now() }}</div>
                </div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">Last modified</div>
                    <div class="col-md-9 text-body ">{{ now() }}</div>
                </div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">Price</div>
                    <div class="col-md-9 text-body ">342000</div>
                </div>
                <div class="border-bottom py-2 row">
                    <div class="col-md-3 text-extra text-capitalize">Product views</div>
                    <div class="col-md-9 text-body ">120</div>
                </div>
                <div class=" py-5">
                    <a class="button-secondary" href="#">Delete</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 px-3 py-4">
            <div class="rounded-md shadow py-4 px-3 bg-white">
                <div class="text-h6 text-uppercase my-2">Default image</div>
                    <img class="img-responsive img-rounded my-3 shadow" src="{{ asset('assets/images/phone.jpg') }}" alt="Chania">
                {{-- <div class="" style="max-height: 35rem;">
                </div> --}}
                <div class="text-h6 text-uppercase my-2">Image gallery</div>
                <div class="row mx-3">
                    @for ($i = 1; $i <= 9; $i++)
                        <div class="col-md-4 p-2">
                            <img class="img-responsive img-rounded my-3 shadow" src="{{ asset('assets/images/background1.png') }}">
                        </div>
                    @endfor
                <div>
            </div>
        </div>
    </div>
@endsection