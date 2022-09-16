<style>
:root {
  --star-size: 30px;
  --star-color: #fff;
  --star-background: #fc0;
}
.Stars {
    --percent: calc(var(--rating) / 5 * 100%);
    display: inline-block;
    font-size: var(--star-size);
    font-family: Times;
    line-height: 1;
}

.Stars::before {
    content: "\2605\2605\2605\2605\2605";
    letter-spacing: 3px;
    background: linear-gradient(90deg
, var(--star-background) var(--percent), var(--star-color) var(--percent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.chat {
	  border: 2px solid #dedede;
	  background-color: #f1f1f1;
	  border-radius: 5px;
	  padding: 10px;
	  margin: 10px 0;
	  color:#000;
	}

	.darker {
	  border-color: #ccc;
	  background-color: #ddd;
	}

	.chat::after {
	  content: "";
	  clear: both;
	  display: table;
	}
.time-right {
  float: right;
  color: #000;
  font-size:12px;
}

.time-left {
  float: left;
  color: #000;
  font-size:12px;
}
.chat .imgdiv {
	float: left;
	max-width: 60px;
	width: 100%;
	margin-right: 20px;
	border-radius: 50%;
	height: 65px;
	border: 1px solid;
	background: #113d6b;
	padding: 15px;
	color: #fff;
	font-weight: bold;
}

.chat .imgdivright {
  float: right;
  margin-left: 20px;
  margin-right:0;
  max-width: 60px;
	width: 100%;
	margin-right: 20px;
	border-radius: 50%;
	height: 65px;
	border: 1px solid;
	background: #113d6b;
	padding: 18px;
	color: #fff;
	font-weight: bold;
	font-size:12px;
	padding-top:17px;
}
.enquiryaccordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  margin-bottom:10px;
}

.enquiryactive, .enquiryaccordion:hover {
  background-color: #ccc;
}

.enquiryaccordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.enquiryactive:after {
  content: "\2212";
}

.panelSlider {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
.username{
float:left;
font-style:italic;
font-weight:bold;
}

.title{
float:left;
width:80%;
}
</style>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div id="carousel-product" class="ms-carousel ms-carousel-thumb carousel slide" data-ride="carousel"
             data-interval="0">
            <div class="card helep_round">
                <!-- Wrapper for slides -->
                <div class="carousel-inner card-body" role="listbox">

                    @foreach($product->images as $i=>$image)
                        <div class="carousel-item withripple {{$i==0?'active':''}} zoom-img">
                            <img class="p-lg-5 m-lg-5 img-caroul" style="max-height:345px;"
                                 src="{{asset('storage/'.$image->image_path)}}"
                                 alt="Product Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Indicators -->
            <ol class="carousel-indicators carousel-indicators-tumbs carousel-indicators-tumbs-outside">

                @foreach($product->images as $k=>$image)
                    <li data-target="#carousel-product" class="{{$k==0?'active':''}} helep_round" data-slide-to="{{$k}}">
                        <img height="80" width="95" src="{{asset('storage/'.$image->image_path)}}"
                             alt="Product Image">
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card helep_round">
            <div class="card-body">
                <h4 class="font-weight-bold text-black-50">{{$product->name}}</h4>
                <div class="mb-2 mt-4">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="Stars" style="--rating: {{$avgRating}};--star-color:#a1abbd;" aria-label="Rating of this product is 2.3 out of 5."></div>
                      <!--<span class="mr-2">
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star"></i>
                      </span>-->
                        </div>
                        <div class="col-sm-6 text-center">
                            <h4 class="color-success no-m text-normal">{{number_format($product->unit_price)}}
                                &nbsp;{{$currency->name}}</h4>
                        </div>
                    </div>
                </div>
                <p class="lead font-16">{{$product->summary}}</p>
                <ul class="list-unstyled">
                    <li>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-bg">
                                <li class="breadcrumb-item shadow-2dp active"><span
                                        class="text-black font-10">@lang('vendor.product_view_category_msg') </span>
                                </li>
                                <li class="breadcrumb-item helep_btn_raise"><a
                                        href="">{{$product->subCategory->category->name}}</a></li>
                                <li class="breadcrumb-item helep_btn_raise"><a
                                        href="">{{$product->subCategory->name}}</a></li>
                            </ol>
                        </nav>
                    </li>
                    <li class="mb-2"><span class="text-black-50">@lang('vendor.product_view_stock_msg') </span> <span
                            class="ms-tag ms-tag-success">in stock</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<div class="ml-lg-2 mr-lg-2 pl-lg-2 pr-lg-5 mt-4 mb-4">
    <div class=" row">
        <div class="col-md-12 card helep_round">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-transparent  indicator-primary nav-tabs-full nav-tabs-4"
                    role="tablist">
                    <li class="nav-item"><a class="nav-link withoutripple active" href="#description"
                                            aria-controls="home"
                                            role="tab" data-toggle="tab"> <span
                                class="font-weight-bold">@lang('vendor.add_product_description_label')</span></a></li>
                    <li class="nav-item"><a class="nav-link withoutripple" href="#supplier" aria-controls="profile"
                                            role="tab" data-toggle="tab"><span
                                class="font-weight-bold">@lang('vendor.shop_info_name')</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link withoutripple" href="#reviews" aria-controls="messages"
                                            role="tab" data-toggle="tab"><span
                                class="font-weight-bold">@lang('vendor.product_details_review_title')</span></a></li>
                    <li class="nav-item"><a class="nav-link withoutripple" href="#enquiry" aria-controls="settings"
                                            role="tab" data-toggle="tab"> <span
                                class="font-weight-bold">@lang('vendor.product_details_enquiry_title')</span></a></li>
                </ul>

                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="description">
                            <div class="text-justify text-black text-center">
                                {!! $product->description !!}
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="supplier">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('vendor.shop_info_general_title')</h3>
                                    </div>
                                    <table class="table table-no-border table-striped">
                                        <tr>
                                            <th>
                                                @lang('vendor.shop_info_name')
                                            </th>
                                            <td class="text-black-50 font-weight-bold">{{$product->shop->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                @lang('shop.add_shop_placeholder_address')
                                            </th>
                                            <td class="text-black-50 font-weight-bold">{{$product->shop->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('shop.shop_info_reg_date_msg')
                                            </th>
                                            <td class="text-black-50 font-weight-bold">{{$product->shop->created_at->diffForHumans()}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            <div class="">
                                <h4>User Reviews</h4>
                                @foreach($ReviewData as $review)
                                    <div class="Stars" style="--rating: {{$review->rating}};--star-color:#a1abbd;" aria-label="Rating of this product is 2.3 out of 5."></div>
                                    <div>
                                    @foreach($reviewImages[$review->id]['images'] as $image)
                                    <img height="80" width="95" src="{{asset('storage/'.$image->image_path)}}"
                                                 alt="Product Image">
                                    @endforeach
                                    </div>
                                    <div>
                                    {!!$review->review!!}
                                    </div>
                                    <div style="font-size:12px;"><i>Reviewed on {{$review->created_at}}</i> By {{$UserName[$review->buyer_id]['user_name']}}</div>
                                @endforeach
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="enquiry">
                            <div>
                                <h4>Enquiry</h4>


                             @foreach($EnquiryData as $enquiry)
                            <button class="enquiryaccordion"><div class="title">{{$enquiry->title}}</div><div class="username"> Enquired By {{$enquiry->name}}</div></button>
                            <div class="panelSlider">
                              @foreach($conversation[$enquiry->id] as $enquiryreply)
                                @if($enquiryreply['mode']=='enquiry')
                                <div class="chat darker">
                                    <div class="imgdivright">
                                    @php
                                    echo substr($enquiry->name,0,1).'.';
                                    echo strtoupper(substr($enquiry->name,strpos($enquiry->name," ")+1,1)).'.';
                                    @endphp
                                    </div>
                                     <div>
                                        @foreach($enquiry['images'] as $image)
                                        <img height="80" width="95" src="{{asset('storage/'.$image->image_path)}}"
                                                     alt="Product Image">
                                        @endforeach
                                        </div>
                                    <div>
                                    {!!$enquiryreply['description']!!}
                                    </div>
                                    <span class="time-left"><i>Enquiry on : {{$enquiryreply['created_at']}}</i></span>
                                </div>
                                @endif
                                @if($enquiryreply['mode']=='reply')
                                <div class="chat">
                                    <div class="imgdiv">
                                    You
                                    </div>
                                    <div>
                                    {!!$enquiryreply['reply']!!}
                                    </div>
                                    <span class="time-right"><i>Replied on : {{$enquiryreply['created_at']}}</i></span>
                                </div>
                                @endif
                        	@endforeach
                              <form class="" method="POST" action="{{route('post_reply')}}">
                                {{ csrf_field() }}
                                <textarea class="form-control html-editor" name="reply" required placeholder="Reply"></textarea>
                                 <input type="submit" class="btn helep_btn_raise text-uppercase" value="Send Reply">
                                 <input type="hidden" name="enquiry_id" value="{{$enquiry->id}}" />
                            	<input type="hidden" name="slug" value="{{$product->slug}}" />
                                </form>
                            </div>
							@endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- card -->
        </div>
    </div>
</div>
<script>
var acc = document.getElementsByClassName("enquiryaccordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("enquiryactive");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
</script>

@section('css')
<link href="{{asset('summernote/dist/summernote.css')}}" rel="stylesheet">
@stop
@section('js')
<script src="{!!asset("summernote/dist/summernote-updated.min.js")!!}"></script>
<script>
$(function () {
	$("#vendor_manage_product").addClass('active');
	loadHtmlEditor();
});
function loadHtmlEditor() {
	if ($('.html-editor')[0]) {
		$('.html-editor').summernote({
			height: 300
		});
	}
	if ($('.html-editor-click')[0]) {
		//Edit
		$('body').on('click', '.hec-button', function () {
			$('.html-editor-click').summernote({
				focus: true
			});
			$('.hec-save').show();
		})
		//Save
		$('body').on('click', '.hec-save', function () {
			$('.html-editor-click').code();
			$('.html-editor-click').destroy();
			$('.hec-save').hide();
			notify('Content Saved Successfully!', 'success');
		});
	}
	//Air Mode
	if ($('.html-editor-airmod')[0]) {
		$('.html-editor-airmod').summernote({
			airMode: true
		});
	}
}
</script>
@endsection

