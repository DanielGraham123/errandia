<div class="card w-100">
    <div class="card-body">
        <form method="post" action="{{route('update_customer_profile')}}">
            <div class="card-title mb-2">
                <h4 class="text-black-50 font-weight-bold p-2 mb-2">{{trans('buyer.update_customer_change_account_profile_info_title')}}</h4>
            </div>
            <br/>
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <label for="gender">{{trans('buyer.buyer_update_profile_gender')}}</label>
                    <div class="form-group">
                        <select name="gender" class="form-control">
                            <option value="none">{{trans('buyer.buyer_update_profile_gender')}}</option>
                            @if(!empty($profile))
                                @if($profile->gender =="M")
                                    <option selected
                                            value="M">{{trans('buyer.buyer_update_profile_gender_male')}}</option>
                                    <option value="F">{{trans('buyer.buyer_update_profile_gender_female')}}</option>
                                @elseif($profile->gender =="F")
                                    <option value="M">{{trans('buyer.buyer_update_profile_gender_male')}}</option>
                                    <option selected
                                            value="F">{{trans('buyer.buyer_update_profile_gender_female')}}</option>
                                @else
                                    <option value="M">{{trans('buyer.buyer_update_profile_gender_male')}}</option>
                                    <option value="F">{{trans('buyer.buyer_update_profile_gender_female')}}</option>
                                @endif
                            @else
                                <option value="M">{{trans('buyer.buyer_update_profile_gender_male')}}</option>
                                <option value="F">{{trans('buyer.buyer_update_profile_gender_female')}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-8 ">
                    <label for="pob">{{trans('buyer.buyer_update_profile_pob')}}</label>
                    <div class="form-group">
                        <input value="{{  !empty($profile) ? $profile->pob: ""}}" name="pob" type="text"
                               class="form-control"
                               placeholder="{{trans('buyer.buyer_update_profile_pob')}}">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="shop_description">{{trans('buyer.buyer_update_profile_dob')}}</label>
                    <div class="form-group">
                        <input id="datePicker" value="{{ !empty($profile) ? $profile->dob: ""}}" name="dob" type="date"
                               class="form-control"
                               placeholder="{{trans('buyer.buyer_update_profile_dob')}}">
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
                                @if(!empty($profile))
                                    <option
                                        value="{{$town->id}}" <?php echo $profile->street->town->id == $town->id ? 'selected="selected"' : '';?>>{{$town->name}}</option>
                                @else
                                    <option value="{{$town->id}}">{{$town->name}}</option>
                                @endif
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
                                @if(!empty($profile))
                                    <option
                                        value="{{$street->id}}" <?php echo $profile->street->id == $street->id ? 'selected="selected"' : '';?> >{{$street->name}}</option>
                                @else
                                    <option value="{{$street->id}}">{{$street->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <select name="category[]" class="form-control" multiple="multiple">
                            <option value="none">{{trans('buyer.buyer_update_profile_categories')}}</option>
                            @foreach($categories as $category)
                                @if(in_array($category->id,$selectedCategories))
                                    <option selected value="{{$category->id}}"> {{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}"> {{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="text-left mt-4 mb-2">
                <button type="submit"
                        class="btn  helep_btn_raise">{{trans('buyer.update_customer_change_account_profile_info_btn')}}</button>
            </div>
        </form>
    </div>
</div>
