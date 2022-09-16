<div class="rounded-lg">
    <div class="pt-2 mt-3 text-center align-items-center my-3 ">
        <h4 class="text-white text-center text-black-50 font-weight-bold">Top Categories</h4>
    </div>
    <div class="ms-paper-menu-left-container">
        <div class="ms-paper-menu-left">
            <div class="panel-menu" id="collapseMenu">
                <ul class="panel-group ms-collapse-nav " id="components-nav" role="tablist" aria-multiselectable="true">
                    @foreach($categories->sortBy('name') as $category)
                        <li class="card mb-1" role="tab" id="category_{{$category->id}}">
                            <a style="background-color: white !important;color: #113d6b !important;" role="button"
                               data-toggle="collapse"
                               href="#c_{{$category->id}}" aria-expanded="false"
                               aria-controls="c_{{$category->id}}" class="withripple collapsed">
                                <img class="img-avatar img-fluid p-2"
                                     style="max-height: 30px; max-width: 30px"
                                     src="{{asset('storage/'.$category->image_path)}}"/>
                                {{$category->name}}
                                <div class="ripple-container"></div>
                            </a>

                            <ul id="c_{{$category->id}}" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="e1" data-parent="#components-nav" style="">
                                @foreach($category->subCategories as $subCategory)
                                    <li><a style="color: #113d6b !important; background-color: white" class="withripple"
                                           href="{{route('show_collection_products',['category'=>$subCategory->slug])}}">
                                            <img class="img-avatar img-fluid p-2"
                                                 style="max-height: 30px; max-width: 30px"
                                                 src="{{asset('storage/'.$subCategory->image_path)}}"/>{{$subCategory->name}}
                                        </a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    <li class="card" id="category_all">
                        <a style="background-color: white !important;color: #113d6b !important;"
                           href="{{route('category_list_page')}}"><i class="fa fa-list"></i>
                            @lang("general.list_categories_all")
                        </a>
                    </li>
                </ul> <!-- ms-collapse-nav -->
            </div>
        </div>
    </div>
    {{--    <div class="d-flex-column align-items-center mb-lg-5">--}}

    {{--        <ul class="navbar-link">--}}

    {{--            @foreach($categories->take(6) as $category)--}}
    {{--                <li id="category_{{$category->id}}" class="mb-1"><a--}}
    {{--                        title="{{$category->name}}"--}}
    {{--                        href="{{route('show_cat_products',['category'=>$category->slug])}}">--}}
    {{--    <img class="img-avatar img-fluid p-2" style="max-height: 30px; max-width: 30px"--}}
    {{--         src="{{asset('storage/'.$category->image_path)}}">--}}
    {{--                        <span class="pl-1">{{$category->name}}</span></a>--}}
    {{--                </li>--}}
    {{--            @endforeach--}}
    {{--        </ul>--}}
    {{--    </div>--}}
</div>
