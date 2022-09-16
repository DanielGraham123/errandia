<div>
    <div class="p-2 m-2">
        <h4
            class="helep-text-color font-weight-bold  pb-2 mb-2">
            @lang('general.components_popular_categories_title')
        </h4>
    </div>
    @foreach(collect($categories)->sortBy('name')->chunk(4) as $chunk)
        <div class="row">
            @foreach($chunk as $category)
                <div class="col-md-3">
                    <div class="">
                        <div class="card-body text-center">
                            <div class="mb-1 pb-1">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="img-avatar img-fluid" style="max-height: 30px; max-width: 30px"
                                             src="{{asset('storage/'.$category->image_path)}}">
                                    </div>
                                    <div class="media-body">
                                        <h5 class="no-m text-left pl-2 text-black-50 font-weight-bold">{{$category->name}}</h5>
                                        <ul class="text-left pl-2">
                                            @foreach($category->subCategories->sortBy('name')->take(4) as $subCategory)
                                                <li class="mb-n3 pb-n3">
                                                    <a class="text-left text-black font-10"
                                                       href="{{route('show_collection_products',['category'=>$subCategory->slug])}}">
                                                        {{$subCategory->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="text-left pl-2">
                                            <a href="{{route('show_cat_products',['category'=>$category->slug])}}"
                                               class="helep-text-color">
                                              <span class="font-weight-bold" style="font-size: 12px">
                                                @lang('general.category_list_more_link') {{$category->name}} <i
                                                      class="zmdi zmdi-arrow-forward font-weight-bold"></i>
                                              </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endforeach


