@extends('b_admin.layout')
@section('section')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 px-0">
                <div class="card shadow bg-white px-2 py-3" style="border-radius: 1rem;">
                    <div class="card-body">
                        <span class="text-h6 d-block text-center mx-auto">{{ $business->name }}</span> <span class="fas fa-verified text-info fa-2x"></span><br>
                        @if ($business->image_path != null)
                            <img src="{{ asset('uploads/logos').$business->image_path }}" class="img-responsive mx-auto my-3" style="width: 5rem; height: 5rem;">
                        @else
                            <span class="fa fa-cog fa-5x text-h1 d-block text-center"></span>
                        @endif
                        <div class="my-2 d-flex justify-content-center">
                            <span class="mr-3">
                                <span class="fa fa-star {{ $business->rating??0 > 0  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                <span class="fa fa-star {{ $business->rating??0 > 1  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                <span class="fa fa-star {{ $business->rating??0 > 2  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                <span class="fa fa-star {{ $business->rating??0 > 3  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                                <span class="fa fa-star {{ $business->rating??0 > 4  ? 'text-warning' : 'text-secondary' }} mx-1"></span>
                            </span>
                            <b class="">{{ $business->rating??0 }} Ratings</b>
                        </div>
                        
                        <div class="my-2 d-flex">
                            <img class="mr-3" styl="height: 2rem; width: 2rem;" src="{{ asset('assets/badmin/icon-location.svg') }}">
                            <b class="">{{ $business->location() }}</b>
                        </div>
                        <div class="my-2 d-flex">
                            <img class="mr-3" styl="height: 2rem; width: 2rem;" src="{{ asset('assets/badmin/icon-member.svg') }}">
                            <b class="">Member since {{ \Carbon\Carbon::parse($business->created_at)->format('Y') }}</b>
                        </div>

                        <div class="my-2 d-flex justify-content-center">
                            <a class="button-primary " href=""><span class="fa fa-whatsapp"></span> Chat on Whatsapp</a>
                        </div>
                        <div class="my-2 d-flex justify-content-center">
                            <a class="button-tertiary " href=""><span class="fa fa-phone"></span> Call 672387532</a>
                        </div>
                        <div class="my-2 d-flex justify-content-center">
                            <a class="button-secondary " href=""> Follow this Business</a>
                        </div>

                        <div class="my-2 text-body">
                            Follow us on social media <br>
                            <span class="fa fa-facebook fa-2x mt-2 mx-2 text-info"></span>
                            <span class="fa fa-instagram fa-2x mt-2 mx-2 text-overline"></span>
                        </div>

                        <hr class="my-4">
                        <span class="text-h6 mb-3">Visit Our Other Branches</span><br>
                        @forelse ($branches as $branch)
                            <div class="my-2 d-flex">
                                <span class="fa fa-angle-right fa-2x mr-3"></span>
                                @if ($branch->image_path != null)
                                    <img src="{{ asset('uploads/logos').$branch->image_path }}" class="img-responsive mx-auto" style="width: 1.5rem; height: 1.5rem;">
                                @else
                                    <span class="fa fa-cog fa-2x text-h1 d-block text-center"></span>
                                @endif
                                <b class="ml-3"> {{ $branch->location() }}</b>
                            </div>
                        @empty
                            <div class="my-2 d-flex">
                                <span class="fa fa-angle-right fa-2x mr-3"></span>
                                @if ($business->image_path != null)
                                    <img src="{{ asset('uploads/logos').$business->image_path }}" class="img-responsive mx-auto" style="width: 1.5rem; height: 1.5rem;">
                                @else
                                    <span class="fa fa-cog fa-2x text-h1 d-block text-center"></span>
                                @endif
                                <b class="ml-3"> {{ $business->location() }}</b>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-9">
                <span class="text-h5 mb-4">Businesses Branches <span class="label label-light label-md rounded border mx-2">{{ $business->branches->count()??0 }}</span></span>
                <div class="mx-5 my-3">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 p-2">
                            <div class="card  px-3 py-5" style="border-radius: 1rem;">
                                @if ($business->image_path != null)
                                    <img class="card-img-top rounded" src="holder.js/100px180/" alt="">
                                @else
                                    <span class="card-img-top rounded fa fa-star fa-5x mx-auto text-center" style="color: var(--color-lightcyan);"></span>
                                @endif
                                <div class="card-body">
                                    <span class="text-semi-extra">{{ $business->category->name??'category' }}</span>
                                    <h4 class="card-title text-link">{{ $business->name }}</h4>
                                    <p class="card-text"><img style="height: 1.3rem; width: 1.3rem;" class="mr-3" src="{{ asset('assets/badmin/icon-location.svg') }}"> {{ $business->location() }}</p>
                                </div>

                                <div class="my-4 px-3">
                                    <a href="{{ route('business_admin.businesses.show', $business->slug) }}" class="h5 text-info text-uppercase">Check this shop</a>
                                </div>
                            </div>
                        </div>
                        @foreach ($business->branches as $branch)
                            <div class="col-sm-6 col-lg-4 p-2">
                                <div class="card px-3 py-5" style="border-radius: 1rem;">
                                    @if ($branch->image_path != null)
                                        <img class="card-img-top rounded" src="holder.js/100px180/" alt="">
                                    @else
                                        <span class="card-img-top rounded fa fa-star fa-5x mx-auto text-center" style="color: var(--color-lightcyan);"></span>
                                    @endif
                                    <div class="card-body">
                                        <span class="text-semi-extra">{{ $branch->category->name??'category' }}</span>
                                        <h4 class="card-title text-link">{{ $branch->name }}</h4>
                                        <p class="card-text"><img style="height: 1.3rem; width: 1.3rem;" class="mr-3" src="{{ asset('assets/badmin/icon-location.svg') }}"> {{ $branch->location() }}</p>
                                    </div>

                                    <div class="my-4 px-3">
                                        <a href="{{ route('business_admin.businesses.show', $branch->slug) }}" class="h5 text-info text-uppercase">Check this shop</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection