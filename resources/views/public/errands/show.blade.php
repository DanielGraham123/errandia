@extends('public.layout')
@section('section')
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-6">
                    <div class="product-left-box">
                        <div class="row g-sm-4 g-2">
                            <div class="col-6 col-grid-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="slider-image">
                                    <img src="{{ asset('assets/images/laptop.jpeg') }}" id="img-1" data-zoom-image="{{ asset('assets/public/assets/images/product/category/1.jpg') }}" class="img-fluid image_zoom_cls-0 blur-up lazyloaded" alt="">
                                </div>
                            </div>

                            <div class="col-6 col-grid-box wow fadeInUp" data-wow-delay="0.05s" style="visibility: visible; animation-delay: 0.05s; animation-name: fadeInUp;">
                                <div class="slider-image">
                                    <img src="{{ asset('assets/images/laptop.jpeg') }}" id="img-2" data-zoom-image="{{ asset('assets/public/assets/images/product/category/2.jpg') }}" class="img-fluid image_zoom_cls-1 blur-up lazyloaded" alt="">
                                </div>
                            </div>

                            <div class="col-6 col-grid-box wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                <div class="slider-image">
                                    <img src="{{ asset('assets/images/laptop.jpeg') }}" id="img-3" data-zoom-image="{{ asset('assets/public/assets/images/product/category/3.jpg') }}" class="img-fluid image_zoom_cls-2 blur-up lazyloaded" alt="">
                                </div>
                            </div>

                            <div class="col-6 col-grid-box wow fadeInUp" data-wow-delay="0.15s" style="visibility: visible; animation-delay: 0.15s; animation-name: fadeInUp;">
                                <div class="slider-image">
                                    <img src="{{ asset('assets/images/laptop.jpeg') }}" id="img-4" data-zoom-image="{{ asset('assets/public/assets/images/product/category/4.jpg') }}" class="img-fluid image_zoom_cls-3 blur-up lazyloaded" alt="">
                                </div>
                            </div>

                            <div class="col-6 col-grid-box wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="slider-image">
                                    <img src="{{ asset('assets/images/laptop.jpeg') }}" id="img-5" data-zoom-image="{{ asset('assets/public/assets/images/product/category/5.jpg') }}" class="img-fluid image_zoom_cls-4 blur-up lazyloaded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="right-box-contain p-sticky wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h2 class="name">I need a Laptop</h2>

                        <div class="procuct-contain">
                            <p>Lollipop cake chocolate chocolate cake dessert jujubes. Shortbread sugar plum dessert
                                powder cookie sweet brownie. Cake cookie apple pie dessert sugar plum muffin cheesecake.
                            </p>
                        </div>

                        <div class="product-packege">
                            <ul class="select-packege">
                                <li>
                                    <a href="javascript:void(0)" class="active">Chat on Whatsapp</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Call</a>
                                </li>
                                
                            </ul>
                        </div>


                        <div class="col-12 ">
                            <div class="border bg-white shadow-md p-5 my-3" style="border-radius: 0.6rem;">
                                <span class="h5" style="color: var(--color-darkblue);">Posted By</span>
                                <span class="d-block"><img style="width: 6rem; height 6rem; border-radius: 50%; border: 1px solid var(--color-darkblue);" src="{{ asset('assets/admin/images/admin-profile-pic.png') }}"> <span class="text-h6 ml-5">{{ $errand->posted_by->name??'user' }}</span></span>
                                <div class="row my-3">
                                    <span class="col-sm-3 text-extra text-capitalize">On</span>
                                    <span class="col-sm-9 text-body-sm text-capitalize">{{ now() }}</span>
                                </div>
                                <div class="row my-3">
                                    <span class="col-sm-3 text-extra text-capitalize">Status</span>
                                    <span class="col-sm-9 text-body-sm text-capitalize"><span class="">Found</span> /Pending</span>
                                </div>
                                <div class="row my-3">
                                    <span class="col-sm-3 text-extra text-capitalize">Location</span>
                                    <span class="col-sm-9 text-body-sm text-capitalize">{{ $errand->location()??'' }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="text-h5 my-3">Related Errands</div>
                    <div class="row g-sm-4 g-3 product-list-section row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-2">
                        @for ($i=0; $i < 12; $i++)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="{{ asset('assets/public/assets/images/charger.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">I need a Dell Laptop charger</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 line-clamp-3">Cheesy feet cheesy grin brie.
                                                Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly
                                                cheese macaroni cheese croque monsieur.</p>
                                            
                                            <h6 class="unit"><span class="fa fa-location"></span>Akwa, Douala</h6>
                                            </h5>
                                            <div class="add-to-cart-box bg-white shadow" >
                                                <a href="{{ route('public.errands.view', 'slug') }}" class="btn btn-add-cart" >View
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </a>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text" name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
