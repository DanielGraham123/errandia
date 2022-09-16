<div class="{{$column}} card {{$card_shadow}} product-image-size">
    <div class="card-body withripple zoom-img">
        <a href="{{route('general_product_details',['id'=>$product->slug])}}">
            <img style="width:280px; max-width:280px; height:251px; max-height:251px"
                 class="img-fluid center-block"
                 src="{{asset('storage/'.$product->featured_image_path)}}"/>
        </a>
        <div class="card-title mt-1"><h5
                class="text-black font-weight-bolder text-center">{{$name}}</h5></div>
        <div class="card-text"><h6
                class="font-weight-bold pb-1 text-muted text-black text-center">{{$currency->name}} {{$product->unit_price}}</h6>
        </div>
    </div>
</div>
