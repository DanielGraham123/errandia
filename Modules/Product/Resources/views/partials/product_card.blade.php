@php
    $length= 100;
         if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                  $name= $match[0]."...";
             } else{
                $name= $product->name;
         }

@endphp

<div class="product-card bg-white p-4 border-bottom-2" style="border-bottom: 1px solid #666">
    <div class="row">
        <div class="col-md-4">
            <div class="product-card-images">
                <a href="{{route('general_product_details',['id'=>$product->slug])}}">
                    <img
                        style="height:251px;"
                        class="card-img-top"
                        src="{{asset('storage/'.$product->featured_image_path)}}"/>
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="product-card-content text-sm-center text-md-left">
                {{--   title and categories     --}}
                <div class="product-card-group">
                    <a href="{{route('general_product_details',['id'=>$product->slug])}}">

                        <h5 class="product-card-title text-black font-weight-bolder">
                            {{$product->name}}

                        </h5>
                    </a>
                </div>
                @if($product->unit_price)
                    {{--  price and quantity  --}}
                    <div class="product-card-group">
                        <h4 class="font-weight-bold pb-1 mb-0 text-muted helep-text-color">{{$product->currency}} {{$product->unit_price}}</h4>
                        {{--                <p class="product-quantity">600</p>--}}
                    </div>
                @endif
                <div class="product-card-group fit-width">
                    <h5
                        class="font-weight-bold text-black">{{$product->shop_name}}</h5>
                </div>
                <div>
                    <h6
                        class="m-0 text-muted">{{$product->shop_address}}</h6>
                </div>
                {{--  Actions --}}
                <div class="product-actions">
                    <a href="tel:{{$product->shop_tel}}"
                       class="btn helep_btn_raise"
                       style="padding: 10px 15px;"><i
                            class="zmdi zmdi-phone"></i>Contact shop
                        <div class="ripple-container"></div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    @media (max-width: 767px) {
        .product-card-content {
            text-align: center;
        }
    }
</style>
