@extends('public.layout')
@section('section')
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="card shadow bg-white px-2 py-3" style="border-radius: 1rem;">
                        <div class="card-body">
                            <span class="text-h6 d-block text-center mx-auto">{{ $shop->name }}</span> <span class="fas fa-verified text-info fa-2x"></span><br>
                            <img src="{{$shop->image_path != null ? asset('uploads/logos/'.$shop->image_path) : asset('assets/images/default1.jpg') }}" class="img-responsive mx-auto my-3 d-block" style="width: 12rem; height: auto;">
                            <div class="my-2 d-flex justify-content-center">
                                <span class="mr-3">
                                    <span class="fa fa-star {{ $shop->rating??0 > 0  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $shop->rating??0 > 1  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $shop->rating??0 > 2  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $shop->rating??0 > 3  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                    <span class="fa fa-star {{ $shop->rating??0 > 4  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                </span>
                                <b class="">{{ $shop->rating??0 }} Ratings</b>
                            </div>
                            
                            <div class="my-2 d-flex">
                                <img class="mr-3" styl="height: 2rem; width: 2rem;" src="{{ asset('assets/badmin/icon-location.svg') }}">
                                <b class="">{{ $shop->location() }}</b>
                            </div>
                            <div class="my-2 d-flex">
                                <img class="mr-3" styl="height: 2rem; width: 2rem;" src="{{ asset('assets/badmin/icon-member.svg') }}">
                                <b class="">Member since {{ \Carbon\Carbon::parse($shop->created_at)->format('M Y') }}</b>
                            </div>

                            <div class="my-2 d-flex justify-content-center">
                                <a class="button-primary" href="https://wa.me/{{ $shop->contactInfo->whatsapp??'' }}?text=`I saw your business; {{ $shop->name }} on Errandia. Can we talk more?`"><span class="fa fa-whatsapp"></span> Chat on Whatsapp</a>
                            </div>
                            <div class="my-2 d-flex justify-content-center">
                                <a class="button-secondary " href="tel:{{ $shop->contactInfo->phone ?? '' }}"><span class="fa fa-phone"></span> Call {{ $shop->contactInfo->phone ?? '???' }}</a>
                            </div>
                            <div class="my-2 d-flex justify-content-center ">
                                <a class="button-secondary " href=""> Follow this Business</a>
                            </div>

                            <div class="my-2 text-body">
                                Follow us on social media <br>
                                <a href="#"><span class="fa fa-facebook fa-2x mt-2 mx-2 text-info"></span></a>
                                <a href="#"><span class="fa fa-instagram fa-2x mt-2 mx-2 text-overline"></span></a>
                                <a href="#"><span class=" fa-2x mt-2 mx-2 text-overline"><i class="fab fa-tiktok text-danger"></i></span></a>
                                <a href="#"><span class=" fa-2x mt-2 mx-2 text-overline"><i class="fa-brands fa-twitter text-primary"></i></span></a>
                            </div>

                            @if(count($branches) > 0)
                                <hr class="my-4">
                                <span class="text-h6 mb-3">Visit Our Other Branches</span><br>
                                @forelse ($branches as $branch)
                                    <a href="{{ route('public.business.show', $branch->slug) }}" class="my-2 d-flex">
                                        <span class="fa fa-angle-right fa-2x mr-3"></span>
                                        @if ($branch->image_path != null)
                                            <img src="{{ asset('uploads/logos/'.$branch->image_path) }}" class="img-responsive mx-auto" style="width: 1.5rem; height: 1.5rem;">
                                        @else
                                            <span class="fa fa-cog fa-2x text-h1 d-block text-center"></span>
                                        @endif
                                        <b class="h6 d-block"> {{ $branch->location() }}</b>
                                    </a>
                                @empty
                                    <div class="my-2 d-flex">
                                        <span class="fa fa-caret-right fa-2x"></span>
                                        @if ($shop->image_path != null)
                                            <img src="{{ asset('uploads/logos/'.$shop->image_path) }}" class="img-responsive mx-2" style="width: 1.5rem; height: 1.5rem;">
                                        @else
                                            <span class="fa fa-cog fa-2x text-h1 d-block text-center mx-2"></span>
                                        @endif
                                        <b class="h6 d-block">No Branches</b>
                                    </div>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9 col-lg-8">
                    <div class="dashboard-right-sidebar">
                        <div>
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-dashboard-tab">
                                <div class="dashboard-home">



                                    {{-- PRODUCTS START --}}
                                    <div class="col-12">
                                        <div class="title title-flex">
                                            <div class="section-b-space w-100">
                                                <div class="mb-5 d-flex flex-wrap justify-content-between">
                                                    <h3> {{ request('type') == 1 ? 'Products' : 'Services' }} </h3>
                                                </div>
                                                <div class="product-border border-row overflow-hidden">
                                                    <div class="product-box-slider no-arrow slick-initialized slick-slider"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: inline-block;">Previous</button>
                                                        
                                                            <div class="slick-slide slick-active w-100" tabindex="0" data-slick-index="1" aria-hidden="false">
                                                                <div class="row m-0">
                                                                    @forelse (request('type') == 1? $products : $services as $key => $prod)
                                                                        <div class="col-12 col-lg-4 col-xxl-3 px-0">
                                                                            <div class="product-box shadow">
                                                                                <div class="product-image">
                                                                                    <a href="{{ route('public.products.show', $prod->slug) }}" tabindex="0">
                                                                                        <img src="{{ $prod->featured_image == null ? asset('assets/images/default1.jpg') : asset('uploads/item_images/'.$prod->featured_image) }}" class="img-fluid blur-up lazyloaded" alt="">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-detail">
                                                                                    <a href="{{ route('public.products.show', $prod->slug) }}" tabindex="0">
                                                                                        <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">{{ $prod->name??'' }}
                                                                                        </h6>
                                                                                    </a>

                                                                                    <h5 class="sold text-content">
                                                                                        <span class="theme-color price">XAF {{ $prod->unit_price ?? "???" }}</span>
                                                                                    </h5>

                                                                                    <div class="add-to-cart-box">
                                                                                        <a href="https://wa.me/{{ $shop->contactInfo->whatsapp??'' }}?text=`I saw {{ $prod->name }} on Errandia. Can we talk more?`" class="button-success text-white"><span class="fa fa-whatsapp mr-1"></span>Chat on Whatsapp</a>
                                                                                        <a href="tel:{{ $shop->contactInfo->phone??'' }}" class="button-secondary text-center"><span class="fa fa-phone mr-1"></span> Call</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="text-center text-danger h6">No products for this shop</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        
                                        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button></div>
                                    </div>
                                    {{-- PRODUCTS END --}}


                                    {{-- SERVICES START --}}
                                    <div class="col-12">
                                        <div class="title title-flex">
                                            <div class="section-b-space w-100">
                                                <div class="mb-5 d-flex flex-wrap justify-content-between">
                                                    <h3>{{ request('type') == 1 ? 'Services' : 'Products' }}</h3>
                                                    <a href="{{ route('public.business.show_items', ['slug'=>$shop->slug, 'type'=> request('type') == 1 ? 2 : 1]) }}" class="button-secondary">See All</a>
                                                </div>
                                                <div class="product-border border-row overflow-hidden">
                                                    <div class="product-box-slider no-arrow slick-initialized slick-slider"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: inline-block;">Previous</button>
                                                        
                                                            <div class="slick-slide slick-active w-100" tabindex="0" data-slick-index="1" aria-hidden="false">
                                                                <div class="row m-0">
                                                                    @forelse (request('type') == 1 ? $services : $products as $key=>$serv)
                                                                        <div class="col-12 col-lg-4 col-xxl-3 px-0">
                                                                            <div class="product-box shadow">
                                                                                <div class="product-image">
                                                                                    <a href="{{ route('public.products.show', $serv->slug) }}" tabindex="0">
                                                                                        <img src="{{ $serv->image_path == null ? asset('assets/images/default1.jpg') : asset('uploads/item_images/'.$serv->image_path) }}" class="img-fluid blur-up lazyloaded" alt="">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-detail">
                                                                                    <a href="{{ route('public.products.show', $serv->slug) }}" tabindex="0">
                                                                                        <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">{{ $serv->name ?? '' }}
                                                                                        </h6>
                                                                                    </a>

                                                                                    <h5 class="sold text-content">
                                                                                        <span class="theme-color price">XAF {{ $serv->unit_price??'???' }}</span>
                                                                                    </h5>

                                                                                    <div class="add-to-cart-box">
                                                                                        <a href="https://wa.me/{{ $shop->contactInfo->whatsapp??'' }}?text=`I saw {{ $serv->name }} on Errandia. Can we talk more?`" class="button-success text-white"><span class="fa fa-whatsapp mr-1"></span>Chat on Whatsapp</a>
                                                                                        <a href="tel:{{ $shop->contactInfo->phone??'' }}" class="button-secondary text-center"><span class="fa fa-phone mr-1"></span> Call</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="text-center text-danger h6">No services for this shop</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: inline-block;">Next</button></div>
                                    </div>
                                    {{-- SERVICES END --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-custome-12">
            </div>
        </div>
    </section>
    
@endsection
@section('script')

@endsection
