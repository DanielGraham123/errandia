@if(!$shops->isEmpty())
    <div class="helep-color container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="m-2"><h4
                        class="index-2 pl-2 text-white font-weight-bold  pb-2 mb-2 text-capitalize">{{$title}}
                    </h4></div>
                @php
                    $column="col-md-2 m-n1 p-n1";
                    $card_shadow ="";
                     if($shops->count() <=5) $column="col-md-3";
                     if($shops->count()<=2) $column="col-md-4";
                @endphp
                <div class="row card-deck">
                    @foreach($shops->sortDesc()->take(5) as $shop)
                        <div class="{{$column}} card {{$card_shadow}} product-image-size">
                            <div class="card-body withripple zoom-img">
                                <a href="{{route('show_shop_page',['id'=>$shop->slug])}}">
                                    <img height="130px" class="card-img-top"
                                         src="{{asset('storage/'.$shop->image_path)}}"/>
                                </a>
                                <div class="card-title"><h5
                                        class="text-black font-weight-bolder text-center">{{$shop->name}}</h5></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <style>
            @media (min-width: 992px) {
                .product-image-size {
                    /*width: 540px;*/
                }
            }
        </style>
    </div>
@endif
