<div class="row p-2">
    <div class="col-md-4 zoom-img withripple">
        <a href="{{route('general_product_details',['id'=>$product->slug])}}">
            <img style="max-height: 150px;max-width: 200px;min-height: 120px; min-width: 165px;"
                 src="{{asset('storage/'.$product->featured_image_path)}}" alt=""
                 class="img-fluid card-img-top">
        </a>
    </div>
    <div class="col-md-8">
        <div class="text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{route('show_cat_products',['category'=>$category->slug])}}">
                            <small>{{$category->name}}</small></a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="{{route('show_collection_products',['category'=>$subCategory->slug])}}">
                            <small>{{$subCategory->name}}</small></a>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="text-left">
            <a href="{{route('general_product_details',['id'=>$product->slug])}}">
                <h5
                    class="text-black font-weight-bolder text-center">{{$product->name}}</h5>
                <h6
                    class="font-weight-bold pb-1 text-muted helep-text-color text-center">{{$currency->name}} {{$product->unit_price}}</h6>
            </a>
        </div>
    </div>
</div>
