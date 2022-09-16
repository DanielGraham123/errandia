<div class="card w-100">

    <div class="card-body">
        <form method="post" action="{{route('update_personal_info')}}">
            @csrf
            <div class="card-title p-2">
                <h5 class="text-black-50 font-weight-bold p-2">{{trans('shop.add_shop_change_account_info_title')}}</h5>
            </div>
            <div class="row form-group">
                <div class="col-md-2">
                    <label for="name">{{trans('shop.add_shop_placeholder_full_name')}} :</label>
                </div>
                <div class="col-md-7">
                    <div class=" ">
                        <input id="name" value="{{$user->name}}" name="name" type="text" class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_full_name')}}">
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row form-group ">
                <div class="col-md-2">
                    <label for="phone_number">{{trans('shop.add_shop_placeholder_tel')}} :</label>
                </div>
                <div class="col-md-7">
                    <div class="">
                        <input id="phone_number" value="{{$user->tel}}" name="phone_number" type="number"
                               class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_tel')}}">
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="text-left mt-4 mb-2">
                <button type="submit"
                        class="btn  helep_btn_raise">{{trans('shop.add_shop_change_personal_info_btn')}}</button>
            </div>
        </form>
    </div>
    <form class="card-body mt-n1" method="post" action="{{route('change_password')}}">
        @csrf
        <div class="card-title p-2">
            <h5 class="text-black-50 font-weight-bold p-2">{{trans('shop.add_shop_change_password')}}</h5>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input required name="old_password" type="password" class="form-control"
                           placeholder="{{trans('shop.add_shop_placeholder_old_password')}}">
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input required name="password" type="password" class="form-control"
                           placeholder="{{trans('shop.add_shop_placeholder_new_password')}}">
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input required name="password_confirmation" type="password" class="form-control"
                           placeholder="{{trans('shop.add_shop_placeholder_confirmed_pass')}}">
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="text-left mt-4 mb-2">
            <button type="submit"
                    class="btn  helep_btn_raise">{{trans('shop.add_shop_change_password')}}</button>
        </div>
    </form>
</div>
