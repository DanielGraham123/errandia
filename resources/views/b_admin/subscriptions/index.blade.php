@extends('b_admin.layout')
@section('section')
    <div class="py-2 container">
        
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <div class="about-us-title text-center">
                <h2 class="center">My Business Subscriptions</h2>
            </div>
           
            <span><span class="text-h4 d-block"> </span> <span class="d-block text-extra"></span></span>
            <span>
                <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3" data-bs-toggle="modal" data-bs-target="#add-address"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Subscribe To A Plan</button>
            </span>
        </div>
        <div class="py-1 px-2 d-flex">

            <table class="table table-responsive">
                <thead class="text-capitalize">
                    <th>#</th>
                    <th>Plan</th>
                    <th>Shop</th>
                    <th>Action</th>
                    <th>Subscribtion date</th>
                    <th>Expiration date</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($subscriptions as $subs)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>{{ $subs->plan->name }}</td>
                            <td>{{ $subs->shop->name }} </td>
                            <td>
                                <div class="dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon icon-only"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="{{ route('business_admin.services.edit', $prod->slug??'') }}" class="text-decoration-none mb-2"> <span class="fa fa-recycle"></span> Renew Subscription</a></li>
                                        <li class="dropdown-item"><a href="{{ route('business_admin.products.show', $prod->slug??'') }}" class="text-decoration-none mb-2"> <span class="fa fa-trash"></span> Cancel Subscription</a></li>
                                    </ul>
                                </div>
                            </td>
                        
                            <td>{{ $subs->subscription_date->format('D dS M Y') }}</td>
                            <td>{{ $subs->expiration_date->format('D dS M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        <!-- Add address modal box start -->
        <div class="modal fade theme-modal" id="add-address" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-h4" id="exampleModalLabel">Subscribe To a Plan</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('business_admin.subscriptions.create') }}">
                        <div class="form-floating mb-4 theme-form-floating">
                            @csrf
                            <select class="form-control" name="shop_id" required>
                                <option value="">select business</option>
                                @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                            <label for="fname">Business</label>
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Sunscription Type: </span>
                            <div class="d-flex flex-wrap justify-content-between">
                                @foreach ($plans as $plan)
                                    <span class="d-flex m-1"><input type="radio" name="subscription_id" value="{{ $plan->id }}" class="mx-1"> {{ $plan->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class=" my-4 theme-form-floating">
                            <span class="text-capitalize">Select Payment Method: </span>
                            <div class="d-flex flex-wrap justify-content-between">
                                <span class="d-flex my-1 mx-2"><input type="radio" name="payment_method" value="MTN" class="mx-1"> <img src="{{ asset('icons/momo.jpg') }}" alt="" class="img border img-rounded mx-1" style="height: 3rem; width: auto;">MTN Mobile Money</span>
                                <span class="d-flex my-1 mx-2"><input type="radio" name="payment_method" value="ORANGE" class="mx-1"> <img src="{{ asset('icons/orange.png') }}" alt="" class="img border img-rounded mx-1" style="height: 3rem; width: auto;">Orange Money</span>
                            </div>
                        </div>
                        <div class="my-4 theme-form-floating">
                            <span class="text-capitalize">Account Number: </span>
                            <div class="">
                                <input type="tel" name="account_number" id="" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end py-2 mt-4">
                            <input type="submit" class="btn theme-bg-color btn-md text-white" value="Proceed">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add address modal box end -->

@endsection