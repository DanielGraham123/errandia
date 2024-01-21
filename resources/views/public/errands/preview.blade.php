@extends('public.layout')
@section('section')

        <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Errand Details</h2>
{{--                        <nav>--}}
{{--                            <ol class="breadcrumb mb-0">--}}
{{--                                <li class="breadcrumb-item">--}}
{{--                                    <a href="index.html">--}}
{{--                                        <i class="fa-solid fa-house"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item active" aria-current="page">Businesses</li>--}}
{{--                            </ol>--}}
{{--                        </nav>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        @foreach($errand->images as $image)
                        <div class="col-6" style="visibility: visible; animation-name: fadeInUp;">
                            <img class="img-responsive img-rounded border" style="border-radius: 0.5rem;height: 90%;width: 90%" src="{{ asset($image->image) }}">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-8">
                    <div class="row g-4">
                        <div class="col-10 mx-auto">
                            <div class="product-left-box">
                                <div class="card py-3 px-3 rounded-md">
                                    <div class="header">
                                        <p class="my-2 d-block text-h5  w-100" id="errandModalLabel">{{$errand->title}}</p>
                                    </div>
                                    <div class="mt-lg-3">
                                        <p class="text-body text-h6  w-30">{{$errand->description}}</p>
                                    </div>
                                    <div class="mt-lg-2">
                                        @foreach($errand->getSubCategories() as $subCategory)
                                            <span class="d-inlineblock rounded border bg-light py-1 px-2 m-1">
                                        <span class="text-extra">{{ $subCategory->name }}</span>
                                    </span>
                                        @endforeach
                                    </div>
                                    <div class="px-1 mt-lg-3">
                                        <p class="text-h6 text-body">{{$errand->location()}}</p>
                                    </div>
                                </div>
                                <div class="px-1 mt-lg-3">
                                    <p class="text-body text-h6">
                                        In order to call or contact this author via WhatsApp, you need
                                        to create you Errandia account
                                    </p>
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <span class="d-flex justify-content-end my-4">
                                                <a href="{{route('register')}}">
                                                    <button class="button-primary" type="submit">Register</button>
                                                </a>
                                            </span>
                                        </div>
                                        <div>
                                            <span class="d-flex justify-content-end my-4">
                                                <a href="{{route('login')}}">
                                                    <button class="button-primary" type="submit">Login</button>
                                                </a>
                                            </span>
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