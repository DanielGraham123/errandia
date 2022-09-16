<div class="card w-100">

    <div class="card-body">
        <form method="post" action="{{route('update_business_info')}}">
            <div class="card-title mb-2">
                <h4 class="text-black-50 font-weight-bold p-2 mb-2">{{trans('shop.add_shop_change_account_business_info_title')}}</h4>
            </div>
            <br/>
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <label for="shop_description">{{trans('shop.add_shop_placeholder_shop_description')}}</label>
                    <div class="form-group">
                            <textarea id="shop_description" name="shop_description" class="form-control html-editor">{{$shop->description}}</textarea>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="shop_contact">{{trans('shop.add_shop_placeholder_tel')}}</label>
                    <div class="form-group">
                        <input value="{{ $shop->shopContactInfo->tel}}" name="shop_contact" type="number"
                               class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_tel')}}">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="shop_address">{{trans('shop.add_shop_placeholder_address')}}</label>
                    <div class="form-group">
                        <input value="{{ $shop->shopContactInfo->address }}" name="shop_address" type="text"
                               class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_address')}}">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <select name="town" class="form-control">
                            <option value="none">{{trans('shop.add_shop_placeholder_town')}}</option>
                            @foreach($towns as $town)
                                <option value="{{$town->id}}" <?php echo $shop->shopContactInfo->town_id==$town->id?'selected="selected"':'';?>>{{$town->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <select name="street" class="form-control">
                            <option value="none">{{trans('shop.add_shop_placeholder_street')}}</option>
                            @foreach($streets as $street)
                                <option value="{{$street->id}}" <?php echo $shop->shopContactInfo->street_id==$street->id?'selected="selected"':'';?> >{{$street->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <label for="website">{{trans('shop.add_shop_placeholder_website')}}</label>
                    <div class="form-group">
                        <input value="{{ $shop->shopContactInfo->website_link }}" name="website" type="text"
                               class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_website')}}">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="facebook_link">{{trans('shop.add_shop_placeholder_facebook')}}</label>
                    <div class="form-group">
                        <input value="{{ $shop->shopContactInfo->facebook_link }}" name="facebook_link" type="text"
                               class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_facebook')}}">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="instagram_link">{{trans('shop.add_shop_placeholder_instagram')}}</label>
                    <div class="form-group">
                        <input value="{{ $shop->shopContactInfo->instagram_link }}" id="instagram_link"
                               name="instagram_link" type="text"
                               class="form-control"
                               placeholder="{{trans('shop.add_shop_placeholder_instagram')}}">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="text-left mt-4 mb-2">
                <button type="submit"
                        class="btn  helep_btn_raise">{{trans('shop.add_shop_change_account_business_info_btn')}}</button>
            </div>
        </form>
    </div>
</div>