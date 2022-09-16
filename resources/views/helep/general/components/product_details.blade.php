<style>
    #phone {
        display: none;
    }

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
        background: linear-gradient(90deg, var(--star-background) var(--percent), var(--star-color) var(--percent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .chat {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        color: #000;
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
        font-size: 12px;
    }

    .time-left {
        float: left;
        color: #000;
        font-size: 12px;
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
        margin-right: 0;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
        height: 65px;
        border: 1px solid;
        background: #113d6b;
        padding: 10px;
        color: #fff;
        font-weight: bold;
        font-size: 12px;
        padding-top: 17px;
    }
</style>
<link href='{{asset('/jquery-bar-rating-master/dist/themes/fontawesome-stars.css')}}' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{url('css/croppie.css')}}">
<div class="row">
    <div class="col-md-6 col-sm-12 card">
        <div id="carousel-product" class=" card-body ms-carousel ms-carousel-thumb carousel slide" data-ride="carousel"
             data-interval="0">
            <div>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($product->images as $k=>$image)
                        <div class="carousel-item {{$k == 0?"active":""}} withripple zoom-img">
                            <img class="p-lg-5 m-lg-5 img-fluid "
                                
                                 src="{{asset('storage/'.$image->image_path)}}"
                                 alt="Product Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Indicators -->
            <ol class="carousel-indicators carousel-indicators-tumbs carousel-indicators-tumbs-outside">
                @foreach($product->images as $i=>$image)
                    <li data-target="#carousel-product" class="helep_round  {{$i == 0?"active":""}}" data-slide-to="{{$i}}"><img
                            height="80" width="95" src="{{asset('storage/'.$image->image_path)}}"
                            alt="Product Image"></li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="col-md-6 card">
        <div class="card-body ">
            <div>
                <h4 class="font-weight-bold text-black-50">{{$product->name}}</h4>
                <div class="mb-2 mt-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="Stars" style="--rating: {{$avgRating}};--star-color:#a1abbd;"
                                 aria-label="Rating of this product is 2.3 out of 5."></div>
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
                <ul class="list-unstyled text-left">
                    <li>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item pr-lg-1"><a
                                        class="text-black font-10">@lang('vendor.product_view_category_msg') </a></li>
                                <li class="breadcrumb-item helep_btn_raise mr-lg-1"><a
                                        style="font-size: 12px !important;color: #fff !important;padding: 2px"
                                        href="{{route('show_cat_products',['category'=>$product->subCategory->category->slug])}}">{{$product->subCategory->category->name}}</a>
                                </li>
                                <li class="breadcrumb-item helep_btn_raise"><a
                                        style="font-size: 12px !important;color: #fff !important;padding: 2px"
                                        href="{{route('show_collection_products',['category'=>$product->subCategory->slug])}}">{{$product->subCategory->name}}</a>
                                </li>
                            </ol>
                        </nav>
                    </li>
                    <li class="mb-2"><span class="text-black-50">@lang('vendor.product_view_stock_msg') </span> <span
                            class="ms-tag ms-tag-success">in stock</span></li>
                </ul>
                <div class="card">
                    <div class="list-group"><a href="{{route('show_shop_page',['id'=>$product->shop->slug])}}"
                                               class="list-group-item list-group-item-action withripple helep-color text-white"><i
                                class="zmdi zmdi-pages"></i>@lang('vendor.shop_info_general_title')
                            <div class="ripple-container"></div>
                        </a> <a href="{{route('show_shop_page',['id'=>$product->shop->slug])}}"
                                class="list-group-item list-group-item-action withripple"><i
                                class="zmdi zmdi-account-o"></i>{{$product->shop->name}}
                            <div class="ripple-container"></div>
                        </a> <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple"><i
                                class="zmdi zmdi-pin"></i>{{$shopLocation}}
                            <div class="ripple-container"></div>
                        </a> <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple"><i
                                class="zmdi zmdi-calendar-account"></i>@lang('shop.shop_info_reg_date_msg'): <span
                                class=" pl-2 text-black-50 font-weight-bold"> {{$product->shop->created_at->diffForHumans()}} </span>
                            <div class="ripple-container"></div>
                        </a></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        @php
                            $whatsappText = trans('general.whatsapp_intro_contact_msg',
                           ['shop'=>$product->shop->name,'product'=>$product->name,
                           'link'=>urlencode(route('general_product_details',['id'=>$product->slug]))]);
                        @endphp
                        <a id="whatsappNumber" target="_blank"
                           href="https://wa.me/{{$product->shop->shopContactInfo->whatsapp_number}}?text={{$whatsappText}}">
                            <button type="button" class="btn helep_btn_raise text-uppercase"
                                    style="background-color: #128c7e !important;"><i
                                    class="zmdi zmdi-whatsapp"></i>@lang('general.product_details_chat_whatsapp_msg')
                            </button>
                        </a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <button type="button" class="btn helep_btn_raise text-uppercase" id="PhoneButton"
                                onclick="show();"><i
                                class="zmdi zmdi-phone-ring"></i>@lang('general.product_details_show_number_msg')
                        </button>
                        <a id="phone" class="btn helep_btn_raise text-uppercase"
                           href="tel:{{$product->shop->shopContactInfo->tel}}">{{$product->shop->shopContactInfo->tel}}</a>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ml-lg-2 mr-lg-2 pl-lg-2 pr-lg-5 mt-4 mb-4">
    <div class=" row">
        <div class="col-md-12 card ">
            <div class="p-1">
                <!-- Nav tabs -->
                <ul class="nav nav-justified nav-fill"
                    role="tablist">
                    <li class="nav-item"><a class="nav-link  active" href="#description"
                                            aria-controls="home"
                                            role="tab" data-toggle="tab"> <span
                                class="font-weight-bold text-black-50">@lang('vendor.add_product_description_label')</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link withoutripple" href="#supplier" aria-controls="profile"
                                            role="tab" data-toggle="tab"><span
                                class="font-weight-bold text-black-50">@lang('vendor.shop_info_name')</span></a></li>
                    <li class="nav-item"><a class="nav-link withoutripple" href="#reviews" aria-controls="messages"
                                            role="tab" data-toggle="tab"><span
                                class="font-weight-bold text-black-50">@lang('vendor.product_details_review_title')</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link withoutripple" href="#enquiry" aria-controls="settings"
                                            role="tab" data-toggle="tab"> <span
                                class="font-weight-bold text-black-50">@lang('vendor.product_details_enquiry_title')</span></a>
                    </li>
                </ul>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="description">
                            <div
                                class="text-justify font-16 text-black text-center"> {!! $product->description !!} </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="supplier">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('vendor.shop_info_general_title')</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-no-border table-striped">
                                        <tr>
                                            <th> @lang('vendor.shop_info_name') </th>
                                            <td class="text-black-50 font-weight-bold">{{$product->shop->name}}</td>
                                        </tr>
                                        <tr>
                                            <th> @lang('shop.add_shop_placeholder_address') </th>
                                            <td class="text-black-50 font-weight-bold">{{$product->shop->shopContactInfo->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('shop.shop_info_reg_date_msg') </th>
                                            <td class="text-black-50 font-weight-bold">{{$product->shop->created_at->diffForHumans()}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            @if(auth()->id()  && $user_type==1)
                                <form class="" enctype="multipart/form-data" method="POST"
                                      action="{{route('post_review')}}">
                                    @csrf
                                    <div class="">
                                        <h4 class="text-black font-weight-bold">@lang('general.product_details_review_title')</h4>
                                        <div class="clearfix"><br/></div>
                                        <div class="form-group mt-2">
                                            <h5 class="text-danger" for="rating_1">Select a rating as stars below
                                                for this
                                                product</h5>
                                            <div class="clearfix"><br/></div>
                                            <select style="font-size: 20px !important;" class='rating form-control'
                                                    id='rating_1' data-id='rating_1'
                                                    name="rating">
                                                <option disabled selected value> -- Select an option --</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>

                                        <h5 class="text-black-50">Upload some sample(s) of this product if you have
                                            bought it before from this supplier</h5>

                                        <div id="review_images" class="row mt-2">

                                        </div>

                                        <h5 class="text-black-50">A brief feedback on your experience using this
                                            product</h5>
                                        <div class="form-group">
                                            <textarea class="form-control  html-editor" name="Comments"
                                                      required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn helep_btn_raise text-uppercase"
                                                   value="Submit Feedback">
                                        </div>

                                    </div>
                                    <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                    <input type="hidden" name="slug" value="{{$product->slug}}"/>
                                    <input id="reviewCounter" type="hidden" name="counter" value="0"/>
                                </form>
                            @else
                                <a href="{{route('login_page')}}">
                                    <button class="btn helep_btn_raise text-uppercase">Login</button>
                                </a> Or

                                <a href="{{route('signup_page')}}">
                                    <button class="btn helep_btn_raise text-uppercase">Register</button>
                                </a>
                            @endif
                            <br/>
                            @foreach($ReviewData as $review)
                                <div class="Stars" style="--rating: {{$review->rating}};--star-color:#a1abbd;"
                                     aria-label="Rating of this product is 2.3 out of 5."></div>
                                <div>
                                    @foreach($reviewImages[$review->id]['images'] as $image)
                                        <img height="80" width="95" class="rounded "
                                             src="{{asset('storage/'.$image->image_path)}}"
                                             alt="Product Review Image">
                                    @endforeach
                                </div>
                                <div> {!!$review->review!!} </div>
                                <div style="font-size:12px;"><i>Reviewed on {{$review->created_at}}</i>
                                    By {{$UserName[$review->buyer_id]['user_name']}}</div>
                            @endforeach </div>
                        <div role="tabpanel" class="tab-pane fade" id="enquiry">
                            <div> @if(auth()->id() && $user_type==1)
                                    <h4 class="text-black font-weight-bold">@lang('general.product_details_enquiry_title')</h4>
                                    <div class="clearfix"><br/></div>
                                    <form class="" method="POST" action="{{route('post_enquiry')}}"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <h5 class="text-black-50">If you have a picture to upload to give a better
                                            description of your enquiry, kindly attach them below</h5>

                                        <div id="inquiries_images" class="row mt-2">

                                        </div>

                                        <div class="form-group">
                                            <h5 class="text-black-50">Enter a title for your enquiry</h5>
                                            <input type="text" class="form-control" name="Title" required
                                                   placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="text-black-50"> Enter a brief description of the enquiry you wish
                                                to make</h5>
                                            <br/>
                                            <textarea class="form-control html-editor" name="Description" required
                                                      placeholder="Enter a brief description of the enquiry you wish to make"></textarea>
                                        </div>
                                        <input type="submit" class="btn helep_btn_raise text-uppercase"
                                               value="Send Enquiry">
                                        <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                        <input type="hidden" name="slug" value="{{$product->slug}}"/>
                                        <input type="hidden" name="ShopOwnerID" value="{{$product->shop->user_id}}"/>
                                        <input id="EnquiryImageCounter" type="hidden" name="EnquiryImageCounter"
                                               value="0"/>
                                    </form>
                                @else
                                    <a href="{{route('login_page')}}">
                                        <button class="btn helep_btn_raise text-uppercase">Login</button>
                                    </a> Or

                                    <a href="{{route('signup_page')}}">
                                        <button class="btn helep_btn_raise text-uppercase">Register</button>
                                    </a>
                                @endif

                            </div>

                            @if($conversation!='')
                                @foreach($conversation as $enquiry)
                                    @if($enquiry['mode']=='enquiry')
                                        <div class="chat">
                                            <div class="" style="font-weight:bold;"> Enquired By
                                                : {{$enquiry['name']}} </div>
                                            <div><b> Title : {{$enquiry['title']}} </b></div>
                                            <div>
                                                @foreach($enquiry['images'] as $image)
                                                    <img height="80" width="95"
                                                         src="{{asset('storage/'.$image->image_path)}}"
                                                         alt="Product Image">
                                                @endforeach
                                            </div>
                                            <div> {!!$enquiry['description']!!} </div>
                                            <span
                                                class="time-right"><i>Enquiry on : {{$enquiry['created_at']}}</i></span>
                                        </div>
                                    @endif
                                    @if($enquiry['mode']=='reply')
                                        <div class="chat darker">
                                            <div class="imgdivright"> Owner</div>
                                            <div> {!!$enquiry['reply']!!} </div>
                                            <span
                                                class="time-left"><i>Replied on : {{$enquiry['created_at']}}</i></span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif </div>
                    </div>
                </div>
            </div>
            <!-- card -->
        </div>
    </div>
</div>
@section('css')
    <link href="{{asset('summernote/dist/summernote.css')}}" rel="stylesheet"/>
@stop
@section('js')
    <script src="{{url('js/croppie.js')}}"></script>
    <script src="{{url('js/moment.js')}}"></script>
    <script src="{!!asset("summernote/dist/summernote-updated.min.js")!!}"></script>
    <script>
        var i = 10000;
        $(function () {
            $("#vendor_manage_product").addClass('active');
            loadHtmlEditor();
            addImage('review_images');
            addImage('inquiries_images');
        });

        function loadHtmlEditor() {
            if ($('.html-editor')[0]) {
                $('.html-editor').summernote({
                    height: 150,
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


        function addImage(section){
            if(section === "inquiries_images"){
                if(i%2 === 1){ //Stay odd for inquiry images
                    i = i+2;
                }else{
                    i = i+1;
                }
            }else{ //stay even ///
                if(i%2 === 1){
                    i = i+1;
                }else{
                    i = i+2;
                }
            }

            html =
                '  <div id="image-' + i + '"  class="col-6 col-sm-6 col-md-4 col-lg-3 mb-2 preview-image">' +
                '     <div  class="d-flex border radius-15   w-100 flex-column h-100 select-photo">' +
                '         <div class="product-img">'+
                '             <input id="photo-'+ i +'" onchange="preViewCrop(event, \''+i+'\' ,\''+section+'\')"  type="file"' +
                '                    class="d-none files"' +
                '                    accept="image/*">' +
                '             <input type="hidden"  name="image[]" class="image-value" id="course_image-' + i + '"/>' +
                '             <img' +
                '                  class="img-fluid d-block" id="preview-' + i + '">' +
                '        </div>' +
                '        <div id="button-' + i + '" class="delete ">' +
                '           <div class="d-flex flex-column w-100 h-100 position-absolute align-items-center justify-content-center">'+
                '               <label for="photo-' + i + '"  class=" mb-0">  <i class="mdi mdi-plus mdi-18px"></i></label>'+
                '          </div>' +
                '        </div>' +
                '     </div>' +
                ' </div>'+



                '<div class="modal fade" id="modal-'+i+'" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="static" data-keyboard="false" >' +
                '    <div class="modal-dialog" role="document">' +
                '        <div class="modal-content">' +
                '            <div class="modal-header">' +
                '                <h5 class="modal-title" id="modalLabel">Crop the image</h5>' +
                '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '                    <span aria-hidden="true">&times;</span>' +
                '                </button>' +
                '            </div>' +
                '            <div class="modal-body">' +
                '                <div class="img-container">' +
                '    <img id="ddimage-'+i+'" style="max-height : 250px; width : auto; object-fit: contain;" src="">' +
                '                </div>' +
                '            </div>' +
                '            <div class="modal-footer">' +
                '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>' +
                '                <button type="button" class="btn btn-primary" id="crop-'+i+'">Crop</button>' +
                '            </div>' +
                '        </div>' +
                '    </div>' +
                '</div>'
            $('#'+section).append(html);
        }

        function preViewCrop(e,j,section) {
            console.log(j)
            var avatar = $('#preview-'+j);
            var input = $('#photo-'+j);
            var image = $('#ddimage-'+j);
            var $modal = $('#modal-'+j);
            var cropper;

            $('[data-toggle="tooltip"]').tooltip();
            var files = e.target.files;

            var done = function (url) {
                input.value = '';
                image.attr('src',url);
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;


            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                    r = new FileReader();
                    r.readAsDataURL(file);
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };

                    reader.readAsDataURL(file);


                }
            }

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image[0], {
                    aspectRatio: 2/1.5,
                    viewMode: 1,
                    ready: function () {
                        var clone = this.cloneNode();
                        clone.className = '';
                        clone.style.cssText = (
                            'display: block;' +
                            'width: 300px;'
                        );
                    },

                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            document.getElementById('crop-'+j).addEventListener('click', function () {
                var initialAvatarURL;
                var canvas;

                $modal.modal('hide');
                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width: 800,
                        height: 600,
                    });
                    avatar.attr('src', canvas.toDataURL());
                    canvas.toBlob(function (blob) {
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function () {
                            var base64data = reader.result;
                            button = '<div class="d-flex flex-nowrap  align-items-center">'+
                                '<label for="photo-' + j + '"  class="btn-success text-center py-2 flex-grow-1 font-10 radius-0">  Change</label>' +
                                '<label onclick="deleteContent(\''+j+'\')"  class="btn-danger text-center  py-2 font-10  flex-grow-1 radius-0"> Remove</label>'
                            '</div>';
                            $('#button-'+j).html(button)

                            if($('#course_image-'+j).val() === "" ){
                                addImage(section)
                            }else{

                            }
                            $('#course_image-'+j).val(base64data)
                        }
                    });
                }
            });

        }

        function deleteContent(j) {
            $('#image-' + j).remove();
        }


    </script>
@endsection
<script>
    function show() {
        document.getElementById("phone").style.display = "block";
        $("#PhoneButton").hide();
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('jquery-bar-rating-master/dist/jquery.barrating.min.js')}}" type="text/javascript"></script>
<script>var jQuery132 = $.noConflict(true);
    jQuery132(document).ready(function () {
        jQuery132('#rating_1').barrating('set', 0);
    });
    jQuery132(function () {
        jQuery132('.rating').barrating({
            theme: 'fontawesome-stars',
            onSelect: function (value, text, event) {
                jQuery132('#feedbackMsg').text('Rating...');
                // Get element id by data-id attribute
                var el = this;
                var el_id = el.$elem.data('id');

                // rating was selected by a user
                if (typeof (event) !== 'undefined') {

                    // AJAX Request
                    jQuery132.ajax({
                        url: 'test',
                        type: 'post',
                        data: {sellerid: sellerid, rating: value, orderid: orderid, buyerid: buyerid},
                        dataType: 'json',
                        success: function (data) {
                            // Update average
                            //var average = data['averageRating'];
                            //jQuery132('#avgrating_'+postid).text(average);
                            jQuery132('#feedbackMsg').css('color', '#00a654');
                            jQuery132('#feedbackMsg').text(data['success']);
                        }
                    });
                }
            }
        });
    });
</script>

