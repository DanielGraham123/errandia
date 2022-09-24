@extends('helep.general.master')
@section('page_title') @lang('general.product_category_list_title',['title'=>$category->name]) @endsection
@section('content')

    <div class="py-5 container-lg">
        <div class="ml-lg-n2 mr-lg-n3 ">
            <div class="text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item font-10"><a class="font-16"
                                                               href="{{route('general_home')}}">
                                <small>@lang('general.footer_menu_home_title')</small></a>
                        </li>
                        <li class="breadcrumb-item"><a class="font-16"
                                                       href="{{route('show_cat_products',['category'=>$category->category->slug])}}">
                                <small>{{$category->category->name}}</small></a>
                        </li>
                        <li class="breadcrumb-item font-10"><a class="font-16"
                                                               href="{{route('show_collection_products',['category'=>$category->slug])}}">
                                <small>{{$category->name}}</small></a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="bg-white row p-1">
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <div class="zoom-img withripple">
                        <img class="img-fluid" style="max-height: 200px"
                             src="{{asset('storage/'.$category->image_path)}}"
                             alt="...">
                    </div>
                </div>
                <div class="col-md-4 text-left">
                    <h4 class="p-1 font-weight-bold text-black-50">{{$category->name}}</h4>
                    <p class="p-1">{{$category->description}}</p>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="text-left col-md-12">
                    <h4 class="font-weight-bold text-black-50">@lang('general.related_category_list_title')</h4>
                </div>
                <br/>
                @php
                    $colum_size ="col-md-2";
                @endphp
                @foreach($relatedSubCategories->sortBy('name')->take(6) as $collection)
                    <div class="card {{$colum_size}} m-2 p-2">
                        <a href="{{route('show_collection_products',['category'=>$collection->slug])}}">
                            <img src="{{asset('storage/'.$collection->image_path)}}"
                                 style="max-height: 120px;max-width:100%" alt="" class="img-fluid">
                            trtrtr
                        </a>
                        <div class="text-center">
                            <a href="{{route('show_collection_products',['category'=>$collection->slug])}}">
                                <h5 class="text-black-50 font-weight-bold text-capitalize">{{$collection->name}}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{--            <div class="clearfix"><br/></div>--}}
            {{--            <div class="row p-1">--}}
            {{--                {!! $featuredCategoryShops !!}--}}
            {{--            </div>--}}
            <div class="clearfix"></div>
            <div class="row card">
                <div class=" card-body col-md-12">
                    <h4
                        class="index-2 text-black-50 font-weight-bold  pb-2 mb-2">
                        @lang('general.product_category_list_heading',['title'=>$category->name])
                    </h4>
                    @include('generalmodule::components.product_list',['category'=>$category->category,'products'=>$subCategoryProducts,'subCategories'=>$subCategories])
                </div>
            </div>
        </div>
    </div>
@endsection
