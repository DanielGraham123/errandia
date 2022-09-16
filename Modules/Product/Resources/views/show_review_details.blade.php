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
</style>
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap"><a href="{{route('product_quote_list')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>

        <div class="row">
        	@foreach ($reviewImages as $image)
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
            <label>Rating</label>
            <div class="Stars" style="--rating: {{$review->rating}};--star-color:#a1abbd;" aria-label="Rating of this product is 2.3 out of 5."></div>
            </div>
          </div>

            <div class="col-12 col-sm-12  mb-2">
            <div class="form-group">
            <label>Review</label>
            {!!$review->review!!}
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
        $(function () {
            //set link indicator
            $("#vendor_sidebar_manage_product_review").addClass('active');
        });

    </script>
@endsection
