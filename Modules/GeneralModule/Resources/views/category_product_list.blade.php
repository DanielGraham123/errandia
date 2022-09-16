@extends('helep.general.master')
@section('page_title') @lang('general.product_category_list_title',['title'=>$category->name]) @endsection
@section('content')

    <div class="py-5 container-lg">
        <div class="ml-lg-n2 mr-lg-n3 ">
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
                @foreach($category->subCategories->sortBy('name')->take(6) as $collection)
                    <div class="card  col-md-2 m-2 p-2">
                        <div class="p-1 text-center">
                            <a href="{{route('show_collection_products',['category'=>$collection->slug])}}">
                                <h5 class="text-black-50 font-weight-bold text-capitalize">{{$collection->name}}</h5>
                                <span
                                    class="text-center font-weight-bolder helep-text-color">{{$collection->products->count()}}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="clearfix"><br/></div>
{{--            <div class="row p-1">--}}
{{--                {!! $randSubCategoryProductList !!}--}}
{{--            </div>--}}
            <div class="clearfix"></div>
            <div class="row card">
                <div class=" card-body col-md-12">
                    <h4
                        class="index-2 text-black-50 font-weight-bold  pb-2 mb-2">
                        @lang('general.product_category_list_heading',['title'=>$category->name])
                    </h4>
                    @include('generalmodule::components.product_list',['products'=>$products,'subCategories'=>$category->subCategories])
                </div>
            </div>
        </div>
    </div>
@endsection
