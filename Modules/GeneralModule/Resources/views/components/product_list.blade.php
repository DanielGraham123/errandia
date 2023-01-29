<div class="p-1">
    <?php
    function isMobileDevice()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
   |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
            , $_SERVER["HTTP_USER_AGENT"]);
    }
    ?>
    @php
        $format="card";
        $column="col-md-2 m-n1 p-n1";
        $card_shadow ="";
         if($products->count() <=5) $column="col-md-3";
    @endphp
    @if(isMobileDevice())
        <div class="row card-deck">
            @foreach($products->sortDesc() as $product)
                @php
                    $length= 30;
                         if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                                  $name= $match[0]."...";
                             } else{
                                $name= $product->name;
                         }
                    $currency = $currencies->where('id',$product->currency_id)->first();
                @endphp
                @include('generalmodule::components.product_item_card_grid',['name'=>$name,'product'=>$product,'currency'=>$currency])
            @endforeach
        </div>
    @else
        @foreach($products->sortDesc()->chunk(2) as $chunk)
            <div class="row">
                @foreach($chunk as $product)
                    @php
                        $length= 150;
                             if (preg_match('/^.{1,'.$length.'}\b/su', $product->name, $match)) {
                                      $name= $match[0]."...";
                                 } else{
                                    $name= $product->name;
                             }
                        $currency = $currencies->where('id',$product->currency_id)->first();
                        $product_sub_category = $subCategories->where('id',$product->sub_category_id)->first();
                        $categoryDetail = isset($category) && !empty($category) ? $category :$product_sub_category->category;

                    @endphp
                    <div class="col-md-6 card helep_round ms-feature">
                        @include('generalmodule::components.product_item_card_list',['product'=>$product,'category'=>$categoryDetail,'currency'=>$currency,'subCategory'=>$product_sub_category])
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5">
            {{ $products->links() }}
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<style>
    @media (min-width: 992px) {
        .product-image-size {
            width: 540px;
        }

        .product-image-height {
            height: 300px;
            max-height: 200px;
            width: 100%;
        }
    }
</style>
