<div>
    <h4
        class="index-2 text-black-50 font-weight-bold  pb-2 mb-2">
        @lang('general.components_popular_collection_title')
    </h4>
    @foreach(collect($collections)->sortBy('name')->chunk(6) as $chunk)
        <div class="row">
            @foreach($chunk as $collection)
                <div class="col-md-2 p-1 ms-feature  wow text-center">
                    <a href="{{route('show_collection_products',['category'=>$collection->slug])}}"
                       class="d-flex-column align-items-center">
                        <div class="shop-avatar"
                             style="height: 100px !important;width: 100px !important;">
                            <img src="{{asset('storage/'.$collection->image_path)}}">
                        </div>
                        <span class="mt-1 text-center text-black-50 font-weight-bold"
                              style="text-overflow: ellipsis; font-size: 13px">{{$collection->name}}</span>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
