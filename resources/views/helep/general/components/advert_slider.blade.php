{{--<div id="carousel-header" class="carousel carousel-header slide pointer-event" data-ride="carousel"--}}
{{--     data-interval="5000">--}}
{{--    <!-- Indicators -->--}}
{{--    <ol class="carousel-indicators">--}}
{{--        <li data-target="#carousel-header" data-slide-to="0" class="active"></li>--}}
{{--        <li data-target="#carousel-header" data-slide-to="1" class=""></li>--}}
{{--        <li data-target="#carousel-header" data-slide-to="2" class=""></li>--}}
{{--    </ol>--}}
{{--    <!-- Wrapper for slides -->--}}
{{--    <div class="carousel-inner" role="listbox">--}}
{{--        <div class="carousel-item carousel-item-next carousel-item-left">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <img width="712px" height="384px" src="https://ng.jumia.is/cms/Homepage/2021/w13/Mobile_Desktop.jpg" alt="..."--}}
{{--                             class="img-fluid mt-6 center-block text-center">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Controls -->--}}
{{--    <a href="#carousel-header"--}}
{{--       class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary left carousel-control" role="button"--}}
{{--       data-slide="prev"><i class="zmdi zmdi-chevron-left"></i></a>--}}
{{--    <a href="#carousel-header"--}}
{{--       class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary right carousel-control" role="button"--}}
{{--       data-slide="next"><i class="zmdi zmdi-chevron-right"></i></a>--}}
{{--</div>--}}
<style>
    .text {
        height: 300px;
        width: 500px;
        background-size: cover;
        position: absolute;
        line-height: 30px;
        text-align: center;
        margin-left: 100px;
        margin-top: 20px;
        padding: 20px;
    }

    .text p {
        color: white;
        display: inline-block;
        background-color: rgba(0, 0, 0, .6);
        padding: 10px;
        width: 500px;
        opacity: 0.9;
        font-size: 20px;
    }
</style>
<div id="carousel-example-generic5" class="ms-carousel ms-carousel-thumb carousel slide helep_round"
     data-ride="carousel">
    <div class="card card-relative">
        <!-- Wrapper for slides -->
        <!--<div class="carousel-inner" role="listbox">
            <div class="carousel-item active  helep_round">
                <img class="d-block img-fluid" style="max-height: 396px"
                     src="https://ng.jumia.is/cms/Homepage/2021/w13/Mobile_Desktop.jpg"
                     alt="...">
            </div>
            <div class="carousel-item  helep_round">
                <img class="d-block img-fluid" style="max-height: 396px"
                     src="https://ng.jumia.is/cms/Homepage/2021/w13/Mobile_Desktop.jpg"
                     alt="...">
            </div>
        </div>-->
        <div class="carousel-inner" role="listbox">
            <?php $i = 0;?>
            @foreach($sliders as $slider)
                <?php
                $startdate = $slider->created_at;
                $expire = strtotime($startdate . ' + ' . $slider->duration . ' days');
                $today = strtotime("today midnight");

                if($today <= $expire)
                {
                ?>
                @if($i==0)
                    <?php $i++;?>
                    <div class="carousel-item active  helep_round">
                        <a style="text-decoration: none" target="_blank" href="{{route('show_collection_products',['category'=>$slider->slug])}}">
                            <img class="d-block img-fluid" style="max-height: 384px; height:384px; width:812px;"
                                 src="{{asset('storage/'.$slider->image)}}" alt="...">
                            <div class="text"><p>{{$slider->caption}}</p></div>
                        </a>
                    </div>
                @else
                    <div class="carousel-item  helep_round">
                        <a style="text-decoration: none" target="_blank" href="{{route('show_collection_products',['category'=>$slider->slug])}}">
                            <img class="d-block img-fluid" style="max-height: 384px; height:384px; width:812px;"
                                 src="{{asset('storage/'.$slider->image)}}"
                                 alt="...">
                            <div class="text"><p>{{$slider->caption}}</p></div>
                        </a>
                    </div>
                @endif
                <?php
                }
                ?>
            @endforeach
        </div>
        <!-- Controls -->
        <a href="#carousel-example-generic5"
           class="btn-circle btn-circle-xs btn-circle-raised helep-color left carousel-control-prev"
           role="button" data-slide="prev"><i class="zmdi zmdi-chevron-left"></i></a>
        <a href="#carousel-example-generic5"
           class="btn-circle btn-circle-xs btn-circle-raised helep-color right carousel-control-next"
           role="button" data-slide="next"><i class="zmdi zmdi-chevron-right"></i></a>
    </div>
    <!-- Indicators -->
    {{--    <ol class="carousel-indicators carousel-indicators-tumbs carousel-indicators-tumbs-outside">--}}
    {{--        <li data-target="#carousel-example-generic5" data-slide-to="0" class="active">--}}
    {{--            <img class="" src="{{asset('images/asset-1.png')}}" alt="">--}}
    {{--        </li>--}}
    {{--        <li data-target="#carousel-example-generic5" data-slide-to="1">--}}
    {{--            <img class="" src="{{asset('images/asset-2.png')}}" alt="">--}}
    {{--        </li>--}}
    {{--    </ol>--}}
</div>
