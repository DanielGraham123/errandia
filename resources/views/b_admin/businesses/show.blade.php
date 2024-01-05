@extends('b_admin.layout')
@section('section')
@php

@endphp
<div class="col-xxl-9">
    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
        Menu</button>
    <div class="dashboard-right-sidebar">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-dashboard-tab">
                <div class="dashboard-home">
                    <div class="title">
                        <h3>{{ $shop->name??"Business Name Here" }}</h3>
                        <span class="title-leaf">
                            <svg class="icon-width bg-gray">
                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>

                    <div class="total-box">
                        <div class="row g-sm-4 g-3">
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="totle-contain">
                                    <div class="totle-detail text-center">
                                        <h5>Products</h5>
                                        <h3>{{ $shop->products->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="totle-contain">
                                    <div class="totle-detail text-center">
                                        <h5>Services</h5>
                                        <h3>{{ $shop->services->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="totle-contain">
                                    <div class="totle-detail text-center">
                                        <h5>Shop Views</h5>
                                        <h3>{{ $shop->products()->sum('views') + $shop->services()->sum('views') }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="totle-contain">
                                    <div class="totle-detail text-center">
                                        <h5>Reviews</h5>
                                        <h3>{{ $shop->reviews->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="totle-contain">
                                    <div class="totle-detail text-center">
                                        <h5>Errands</h5>
                                        <h3>10</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-title">
                        <h3>Business Details</h3>
                    </div>

                    <div class="row g-4">
                        <div class="col-xl-6">
                            <div class="dashboard-contant-title">
                                <h4>Contact Information <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#add-address">Edit</a>
                                </h4>
                            </div>
                            <div class="dashboard-detail">
                                <h6 class="text-content"><span class="fa fa-location"></span> {{ $shop->contactInfo->location() }}</h6>
                                <h6 class="text-content"><span class="fa fa-whatsapp"></span> {{ $shop->contactInfo->whatsapp??'------' }}</h6>
                                <h6 class="text-content"><span class="fa fa-phone"></span> {{ $shop->contactInfo->phone??'------' }}</h6>
                                <h6 class="text-content"><span class="fa fa-message"></span> {{ $shop->contactInfo->email??'------' }}</h6>
                                <h6 class="text-content"><span class="fa fa-facebook"></span> {{ $shop->contactInfo->facebook??'------' }}</h6>
                                <h6 class="text-content"><span class="fa fa-instagram"></span> {{ $shop->contactInfo->instagram??'------' }}</h6>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="dashboard-contant-title">
                                <h4>Categories <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#categories">Edit</a></h4>
                            </div>
                            <div class="dashboard-detail">
                                @foreach($shop->subCategories as $scat)
                                    <small class="text-content px-3 py-1 m-1">{{ $scat->name }}</small>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dashboard-contant-title">
                                <h4>Description <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#description">Edit</a></h4>
                            </div>

                            <div class="row g-4">
                                <div class="col-xxl-6">
                                    <div class="dashboard-detail">
                                        <h6 class="text-content">{{$shop->description??''}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="text-h5 my-3">{{ $shop->name??"Business Name Here" }}</div>


    
    <div class="mx-3 rounded py-4 px-2">
        <span class="text-uppercase h6 my-3 d-block">Business details</span>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Business name  </span><span class="text-secondary text-capitalize">{{ $shop->name }} @if($shop->id_branch != 1) <label class="label label-in label-primary">Head Office</label> @endif</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Ratings  </span><span class="text-secondary text-capitalize">{{ number_format($shop->reviews()->sum('rating') / (($cnt = ($shop->reviews->count())) == 0 ? 1 : $cnt), 1) }}</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Verification status  </span><span class="text-secondary text-capitalize fa fa"> @if($shop->status == 1) <span class="fa fa-certificate fa-2x text-primary"></span> Verified @else <span class="fa fa-question fa-2x text-primary"></span> Unverified @endif </span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Categories  </span><span class="text-secondary text-capitalize">Rubiliams Hair clinic</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Website  </span><span class="text-secondary text-capitalize">{{ $shop->contactInfo->website??'' }}</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Phone  </span><span class="text-secondary text-capitalize">{{  $shop->contactInfo->phone??'' }}</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Email  </span><span class="text-secondary text-capitalize">{{  $shop->contactInfo->email??'' }}</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Location  </span><span class="text-secondary text-capitalize">{{  $shop->contactInfo->location() }}</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Created On  </span><span class="text-secondary text-capitalize">{{ $shop->created_at->format('D dS M Y') }}</span>
        </div>
        <div class="row my-3 border-bottom">
            <span class="mr-5 text-capitalize text-extra">Business Category  </span><span class="text-secondary text-capitalize">{{ $shop->category->name??'' }}</span>
        </div>
        <div class="row my-3 d-flex text-capitalize">
            <a href="#" class="button-primary text-white"><span class="fa fa-edit icon"></span>edit business</a>
            <a href="#" class="btn btn-md btn-danger mx-3"><span class="fa fa-block icon"></span>suspend</a>
        </div>
    </div>
    <div class="row">
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 ">Staff</div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-info arrowed-in">Branch Location</span>
                    </div>
                </div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-info arrowed-in">Branch Location</span>
                    </div>
                </div>
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Add Staff</a>
                </div>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-3 shadow" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 ">Branches <span class="text-primary">02</span></div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-light arrowed-in">Products: <span class="text-dark">12</span> Services<span class="text-dark">02</span></span>
                    </div>
                </div>
                <div class="row bg-white rounded border my-2 px-3 mx-5 shadow">
                    <span class="col-sm-2">
                        <span class="fa fa-user fa-3x text-primary"></span>
                    </span>
                    <div class="col-sm-10">
                        <span class="d-block my-1 h5 my-2 text-dark h6">Juston King</span>
                        <span class="label label-light arrowed-in">Products: <span class="text-dark">12</span> Services<span class="text-dark">02</span></span>
                    </div>
                </div>
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Add Branch</a>
                </div>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-3 shadow px-5" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 d-flex justify-content-around">
                    <span>Subscription</span> <span class="text-extra">Expiry Date: <span class="text-danger">{{ now() }}</span></span>
                </div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Plan  </span><span class="text-secondary text-capitalize">Yearly, XAF 234652</span>
                </div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Subscription status  </span>
                    <span class="text-secondary text-capitalize"><span class="label label-sm label-info arrowed-in">Active</span></span>
                </div>
                
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Update Subscription Status</a>
                </div>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="py-4 my-5 px-5 shadow" style="border-radius: 0.8rem;">
                <div class="text-h5 text-center text-uppercase my-3 ">SMS Plan</div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Plan  </span><span class="text-secondary text-capitalize">Yearly, XAF 234652</span>
                </div>
                <div class="row my-3 border-bottom">
                    <span class="mr-5 text-capitalize text-extra">Status  </span>
                    <span class="text-secondary text-capitalize"><span class="label label-sm label-info arrowed-in">Active</span></span>
                </div>
                <div class="my-2 py-5 mx-2">
                    <a href="#" class="button-secondary">Update SMS Plan</a>
                </div>
            </div>
        </div>

    </div>
</div>


    <!-- Contact info modal -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-h4" id="exampleModalLabel">Business Contact Info</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-floating mb-4 theme-form-floating">
                            <span class="text-capitalize">Location</span>
                            <div class="row">
                                <div class="col-12 my-1">
                                    <small class="text-secondary text-uppercase">region</small>
                                    <select name="region" class="form-control input-sm" required onchange="loadTowns(event)">
                                        <option></option>
                                        @foreach($regions as $key => $reg)
                                            <option value="{{$reg->id}}">{{$reg->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 my-1">
                                    <small class="text-secondary text-uppercase">town</small>
                                    <select name="town" class="form-control input-sm select_town" required onchange="loadStreets(event)">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-6 my-1">
                                    <small class="text-secondary text-uppercase">street</small>
                                    <select name="street" class="form-control input-sm select_street" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">address</span>
                            <input class="form-control input-sm" name="address" type="text" value="{{ $shop->contactInfo->address }}">
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Whatsapp number</span>
                            <input class="form-control input-sm" name="whatsapp" type="tel" value="{{ $shop->contactInfo->whatsapp }}">
                        </div>
                        <div class=" my-4 theme-form-floating">
                            <span class="text-capitalize">Phone number</span>
                            <input class="form-control input-sm" name="phone", type="tel" value="{{ $shop->contactInfo->phone }}">
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Business Email</span>
                            <input class="form-control input-sm" name="email" value="{{ $shop->contactInfo->email }}" type="email">
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Website</span>
                            <input class="form-control input-sm" name="website" value="{{ $shop->contactInfo->website }}" type="url">
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Facebook</span>
                            <input class="form-control input-sm" name="facebook" value="{{ $shop->contactInfo->facebook }}" type="url">
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">instagram</span>
                            <input class="form-control input-sm" name="instagram" value="{{ $shop->contactInfo->instagram }}" type="url">
                        </div>
                        <div class="d-flex justify-content-end py-2 mt-4">
                            <input type="submit" class="btn theme-bg-color btn-md text-white" value="Proceed">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact info modal end -->

    <!-- Categories modal -->
    <div class="modal fade theme-modal" id="categories" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-h4" id="exampleModalLabel">Business Sub-Categories</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="">
                        @csrf
                        {{-- <div class="form-floating mb-4 theme-form-floating">
                            <span class="text-capitalize">Categories</span>
                            <select name="category" class="form-control input-sm" required onchange="loadSubCats(event)">
                                <option></option>
                                @foreach($categories as $key => $cat)
                                    <option value="{{$cat->id}}" {{$shop->category->id == $cat->id ? 'selected' : ''}}>{{$cat->name??''}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Sub Categories</span>
                            <div class="card">
                                <div class="card-body" id="select_subcats">
                                    @foreach($all_sub_categories as $key => $scat)
                                        <span class="px-2 py-1 text-secondary"><input type="checkbox" class="mx-1" name="sub_categories[]" value="{{$scat->id}}" {{in_array( $scat->id, $shop_subcats->pluck('id')->toArray()) ? 'checked' : ''}}>{{$scat->name}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- <div class="my-4 theme-form-floating">
                            <div class="card">
                                <div class="card-body" id="dump_subcats">
                                    
                                </div>
                            </div>
                        </div> --}}
                        <div class="d-flex justify-content-end py-2 mt-4">
                            <input type="submit" class="btn theme-bg-color btn-md text-white" value="Proceed">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories modal end -->

    <!-- Description modal -->
    <div class="modal fade theme-modal" id="description" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-h4" id="exampleModalLabel">Business Description</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-floating mb-4 theme-form-floating">
                            <span class="text-capitalize">description</span>
                            <textarea name="description" class="form-control input-sm" required>{{$shop->description??''}}
                            </textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end py-2 mt-4">
                            <input type="submit" class="btn theme-bg-color btn-md text-white" value="Proceed">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Description modal end -->
@endsection






@section('script')
    <script>
        let loadTowns = function(event){
            let region = event.target.value;
            let url = "{{ route('region.towns', '_RID_') }}".replace('_RID_', region);
            $.ajax({
                method: 'get', url: url,
                success: function(data){
                    towns = $data.data;
                    let html = `<option></option>`;
                    towns.forEach(town=>{
                        html += `<option value="${town.id}">${town.name}</option>`
                    });
                    $('.select_town').forEach(element=>{
                        $(element).html(html);
                    });
                }
            })
        }
        let loadStreets = function(event){
            let town = event.target.value;
            let url = "{{ route('town.streets', '_TID_') }}".replace('_TID_', region);
            $.ajax({
                method: 'get', url: url,
                success: function(data){
                    streets = $data.data;
                    let html = `<option></option>`;
                    streets.forEach(street=>{
                        html += `<option value="${street.id}">${element.name}</option>`;
                    });
                    $('.select_street').forEach(elm=>{
                        $(elm).html(html);
                    });
                }
            })
        }
    </script>
@endsection
