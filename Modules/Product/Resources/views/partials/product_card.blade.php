@php
    $length= 100;
         if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                  $name= $match[0]."...";
             } else{
                $name= $product->name;
         }
$currency = $currencies->where('id',$product->currency_id)->first();
@endphp

<div class="err-product-card bg-white p-4 border-bottom-2 card">
    <div class="row">
        <div class="col-md-4">
            <div class="product-card-images">
                <a href="{{route('show_product',['id'=>$product->slug])}}">
                    <img style="max-height:100px;max-width: 100px" height="100px"
                         width="100px"
                         src="{{asset('storage/'.$product->featured_image_path)}}" alt=""
                         class=" rounded-lg  center-block">
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="product-card-content text-sm-center text-md-left">
                {{--   title and categories     --}}
                <div class="product-card-group">
                        <h4 class="product-card-title text-black font-weight-bolder">
                            {{$product->name}}
                        </h4>
                    <p>{{$product->summary}}</p>
                </div>
                @if($product->unit_price)
                    {{--  price and quantity  --}}
                    <div class="product-card-group">
                        <h4 class="font-weight-bold pb-1 mb-0 text-muted helep-text-color">{{number_format($product->unit_price)." ".$currency->name}}</h4>
{{--                        <h5 class="ms-tag btn helep_btn_raise">{{number_format($product->unit_price)." ".$currency->name}}</h5>--}}
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
                    <a href="{{route('show_product',['id'=>$product->slug])}}" class="text-muted">
                        <i class="fa fa-eye text-info"></i>&nbsp;{{trans('admin.view_msg')}}
                    </a>
                    <a href="{{route('edit_product',['id'=>$product->slug])}}" class="text-muted p-1 m-1"><i
                            class=" fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                    <a href="{{route('delete_product',['id'=>$product->slug])}}" class="text-muted"><i
                            class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .err-product-card{
        height: 90%;
    }
    @media (max-width: 767px) {
        .product-card-content {
            text-align: center;
        }
        .err-product-card{
            height: 95%;
        }
    }
</style>
