@extends('public.layout')
@section('section')

        <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Region Name</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Businesses</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custome-3">
                    <div class="left-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="shop-left-sidebar">
                            <div class="location-list nav-link">
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Region</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Town</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                                <div class="search-input my-3">
                                    <select class="form-control">
                                        <option>Street</option>
                                    </select>
                                    {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-custome-9">
                    <div class="row g-4">
                        <div class="col-10 mx-auto">
                            <div class="product-left-box">
                                
                                <div class="card py-3 px-2 rounded-md ">
                                    <div class="header">
                                        <h5 class="title text" id="errandModalLabel">Contact Errand Author</h5>
                                    </div>
                                    <div class="">
                                        <p class="text-body">In order t call or contact this author via WhatsApp , you need
                                            to create you Errandia account</p>
                                        <div class="d-flex rounded-md border bg-light py-3 px-2">
                                            <div class="w-25 mr-5">
                                                <img class="img-responsive img-rounded border" style="width: 100%; height: 100%; border-radius: 0.5rme;" src="{{ asset('assets/images/laptop.jpeg') }}">
                                            </div>
                                            <div class="mx-2">
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
            </div>
        </div>
    </section>
@endsection