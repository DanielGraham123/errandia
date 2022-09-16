<div class="m-1 align-items-center">
    <h4
        class="text-white font-weight-bold  pb-2 mb-2">
        @lang('general.components_popular_shops_title')
    </h4>
    @foreach(collect($shops)->sortBy('name')->chunk(6) as $chunk)
        <div class="row">
            @foreach($chunk as $shop)
                <div class="col-md-2 p-1 text-center">
                    <a href="{{route('show_shop_page',['id'=>$shop->slug])}}"
                       class="d-flex-column align-items-center">
                        <div class="shop-avatar"
                             style="height: 100px !important;width: 100px !important; background-color: #FAFAFA
 !important">
                            <img src="{{asset('storage/'.$shop->image_path)}}">
                        </div>
                        <span class="mt-1 text-center text-white font-weight-bold"
                              style="text-overflow: ellipsis; font-size: 13px">{{$shop->name}}</span>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
