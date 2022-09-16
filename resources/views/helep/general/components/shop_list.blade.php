
<div class="m-2 p-2 align-items-center">
    <h4 class="text-white font-weight-bold  pb-2 mb-2">@lang('general.components_popular_shops_title')</h4>
    @foreach(collect($shops)->sortBy('name')->chunk(6) as $chunk)
        <div class="row mb-2">
                    @foreach($chunk as $shop)
                        <div class="col-md-2 col-sm-12">
                                <a href="{{route('show_shop_page',['id'=>$shop->slug])}}"
                                   class="">
                                    <img src="{{asset('storage/'.$shop->image_path)}}" class="img-responsive"
                                         style="border-radius: 50%; max-height:100px; height: 100px;width: 100px; max-width: 100px"><br/>
                                    <span class="mt-1 text-center text-white font-weight-bold"
                                          style="text-overflow: ellipsis; font-size: 13px">{{$shop->name}}</span>
                                </a>
                        </div>
                    @endforeach
         </div>
    @endforeach
</div>

