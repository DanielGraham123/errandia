<div class="row">
    <div class="col-md-12">
        <div class="m-2"><h4 class="index-2 text-black-50 font-weight-bold  pb-2 mb-2">{{$title}}</h4></div>
        @php
            $column="col-md-2 m-n1 p-n1";
            $card_shadow ="";
             if($shopProducts->count() <=5) $column="col-md-3";
            if($product_route_name =="show_product") $card_shadow ="helep_round";
        @endphp
        <div class="row card-deck">
            @foreach($shopProducts->sortDesc()->take(6) as $product)
                @php
                    $length= 30;
                         if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                                  $name= $match[0]."...";
                             } else{
                                $name= $product->name;
                         }
                    $currency = $currencies->where('id',$product->currency_id)->first();
                @endphp

                <div class="{{$column}} card {{$card_shadow}} " >
                    <div class="card-body withripple zoom-img">
                        <a href="{{route($product_route_name,['id'=>$product->slug])}}">
                            @if(!isMobile())
                            <img height="130px" class="card-img-top" src="{{asset('storage/'.$product->featured_image_path)}}"/>
                            @else
                              <img style="width:290px; max-width:290px; height:261px; max-height:261px" class="img-fluid center-block"
                                 src="{{asset('storage/'.$product->featured_image_path)}}"/>   
                            @endif
                                 
                        </a>
                        <div class="card-title mt-1"><h5
                                class="text-black font-weight-bolder text-center">{{$name}}</h5></div>
                        <div class="card-text"><h6
                                class="font-weight-bold pb-1 text-muted text-black text-center">{{$currency->name}} {{$product->unit_price}}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    @media (min-width: 992px) {
        .product-image-size {
            width: 540px;
        }
    }
</style>
