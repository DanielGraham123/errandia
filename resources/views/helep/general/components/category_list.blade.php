<div>
    <div class="rounded-lg shadow-lg">
        <h4
            class="helep-color alert text-white font-weight-bold  pb-2 mb-2">
            @lang('general.components_popular_categories_title')
        </h4>
    </div>
    @foreach(collect($categories)->sortBy('name')->chunk(6) as $chunk)
        <div class="row">
            @foreach($chunk as $category)
                <div class="col-md-2">
                    <div class="ms-feature wow">
                        <div class="card-body overflow-hidden text-center">
                            <div class="mb-1 pb-1">
                                <a href="{{route('show_cat_products',['category'=>$category->slug])}}">
                                    <img style="max-height: 80px; max-width: 80px"
                                         src="{{asset('storage/'.$category->image_path)}}" alt=""
                                         class="img-fluid center-block"></a>
                            </div>
                            <span class="mt-2 text-center text-black-50 font-weight-bold"
                                  style="text-overflow: ellipsis; font-size: 13px">{{$category->name}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endforeach


