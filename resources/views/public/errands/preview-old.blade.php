@extends('public.layout')
@section('section')
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-6">
                    <div class="product-left-box">
                        
                        <div class="card py-3 px-2 rounded-md ">
                            <div class="header">
                                <h5 class="title text" id="errandModalLabel">Contact Errand Author</h5>
                            </div>
                            <div class="">
                                <p class="text-body">In order t call or contact this author via WhatsApp , you need
                                    to create you Errandia account</p>
                                <div class="d-flex rounded-md border bg-light py-3 px-2">
                                    <div class="w-25">
                                        <img class="img-responsive" style="width: 100%; height: 100%; border-radius: 0.5rme;" src="{{ asset('assetsassets/images/charger.png') }}">
                                    </div>
                                    <div>
                                        <span class="text-h6 my-2 d-block">I need a Laptop charger</span>
                                        <p class="text-body">Quia minus eaque quisquam. Dolores eos ea. Veritatis recusandae minus accusamus deserunt animi impedit</p>
                                    </div>
                                </div>
                                <div class="my-3 d-flex justify-content-netween">
                                    <a class="button-primary" href="#">Create your Account</a>
                                    <a class="button-tertiary" href="#">Sign in</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
