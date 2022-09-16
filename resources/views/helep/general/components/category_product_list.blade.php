@if(!$products->isEmpty())
    <div class="panel panel-dark helep-color">
        <div class="row">
            <div class="col-md-12">
                <div class="m-2"><h4
                        class="index-2 pl-2 text-white font-weight-bold  pb-2 mb-2 text-capitalize">{{$category}}
                        | <small>@lang('general.components_trending_cat_title')</small></h4></div>
                @php
                    $column="col-md-2 m-n1 p-n1";
                    $card_shadow ="";
                     if($products->count() <=5) $column="col-md-3";
                @endphp
                <div class="row card-deck">
                    @foreach($products->sortDesc()->take(5) as $product)
                        @php
                            $length= 30;
                                 if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                                          $name= $match[0]."...";
                                     } else{
                                        $name= $product->name;
                                 }
                            $currency = $currencies->where('id',$product->currency_id)->first();
                        @endphp

                        <div class="{{$column}} card {{$card_shadow}} product-image-size">
                            <div class="card-body withripple zoom-img">
                                <a href="{{route('general_product_details',['id'=>$product->slug])}}">
                                    <img height="130px" class="card-img-top"
                                         src="{{asset('storage/'.$product->featured_image_path)}}"/>
                                </a>
                                <div class="card-title mt-1"><h5
                                        class="text-black font-weight-bolder text-center">{{$name}}</h5></div>
                                <div class="card-text"><h6
                                        class="font-weight-bold pb-1 text-muted helep-text-color text-center">{{$currency->name}} {{$product->unit_price}}</h6>
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
    </div>
@endif
