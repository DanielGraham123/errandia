@extends('helep.vendor.layout.master')
@section('content')
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
.fade:not(.show) {
     opacity: 1;
}
</style>
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap"><a href="{{route('product_enquiry_list')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>

        <div class="row">
        	@foreach ($enquiryImages as $image)
            <div class="col-6 col-sm-3  mb-2">
              <div for="photo-1" class="d-flex border radius-15  w-100 select-photo">
                <div class="rounded-lg"><img id="preview-1" height="100%" width="100%" src="{{asset('storage/'.$image->image_path)}}"></div>
              </div>
            </div>
            @endforeach
         </div>
         <div class="row">
         <div class="col-12 col-sm-12  mb-2">
            <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="Title"  value="{{$enquiry->title}}"  placeholder="Title" disabled="disabled"/>
            </div>
          </div>

            <div class="col-12 col-sm-12  mb-2">
            <div class="form-group">
            <label>Description</label>
            <?php echo $enquiry->description;?>
            </div>
            <!--<form class="" method="POST" action="{{route('enquirypostreply')}}">
            {{ csrf_field() }}
            <textarea class="form-control html-editor" name="reply" required placeholder="Reply"></textarea>
             <input type="submit" class="btn helep_btn_raise text-uppercase" value="Send Reply">
             <input type="hidden" name="enquiry_id" value="{{$enquiry->id}}" />
            <input type="hidden" name="slug" value="" />
            </form>-->
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
                              <form class="" method="POST" action="{{route('enquirypostreply')}}">
                                {{ csrf_field() }}
                                  @include('helep.general.components.richtext_editor',['textareaName'=>'reply'])

                                  <input type="submit" class="btn helep_btn_raise text-uppercase" value="Send Reply">
                                 <input type="hidden" name="enquiry_id" value="{{$enquiry->id}}" />
                            	<input type="hidden" name="slug" value="" />
                                </form>
                            </div>
							@endforeach


                            </div>
                        </div>
            </div>


          </div>

    </div>
    <style>
        @media (max-width: 574px ) {
            .img-caroul {
                max-width: 200px !important;
            }
        }
    </style>
@endsection


@section('js')
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
        $(function () {
            //set link indicator
            $("#vendor_sidebar_manage_product_enquiry").addClass('active');
        });


    $(function () {
	$("#vendor_manage_product").addClass('active');
});
</script>
@endsection
