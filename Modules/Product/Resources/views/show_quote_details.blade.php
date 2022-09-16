@extends('helep.vendor.layout.master')
@section('content')
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
        	@foreach ($quoteImages as $image)
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
            <input type="text" class="form-control" name="Title"  value="{{$quote->title}}"  placeholder="Title" disabled="disabled"/>
            </div>
          </div>
          <div class="col-12 col-sm-12  mb-2">
            <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="PhoneNumber"   value="{{$quote->phone_number}}"  placeholder="Phone Number" disabled="disabled"/>
            </div>
            </div>
            <div class="col-12 col-sm-12  mb-2">
            <div class="form-group">
            <label>Description</label>
            <textarea class="form-control html-editor" rows="5" name="Description" required placeholder="Description">  {{$quote->description}}</textarea>
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
            $("#vendor_sidebar_manage_product_quote").addClass('active');
        });
    </script>
@endsection
