@extends('helep.vendor.layout.master')
@section('content')
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <a href="{{route('product_quote_list')}}">
                <button type="button" class="btn helep_btn_raise">
                    <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
            </a>
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <form action="{{url('products/quotes/'.$quote->id)}}" method="POST" class="mr-4">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="bg-transparent border-0" title="Trash">
                        <i class="fa fa-trash-alt text-danger"></i>
                    </button>
                </form>

                <p class="mb-0">{{ \Carbon\Carbon::parse($quote->created_at)->toFormattedDateString()}}</p>
            </div>

        </div>


        <div class="row">
            @foreach ($quoteImages as $image)
                <div class="col-6 col-sm-3  mb-2">
                    <div class="rounded-lg">
                        <img id="preview-1" style="height: 200px" width="100%"
                             src="{{asset('storage/'.$image->image_path)}}">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 mb-2 border-bottom">
                <label>Title</label>
                <p class="text-black">{{$quote->title}}</p>
                {{--            <input type="text" class="form-control" name="Title"  value="{{$quote->title}}"  placeholder="Title" disabled="disabled"/>--}}

            </div>
            <hr>
            <div class="col-12 col-sm-12 mb-2 border-bottom">
                <label>Phone Number</label>
                <div class="d-flex flex-wrap align-items-center ">
                    <p class="text-black mb-0 mr-3">{{$quote->phone_number}}</p>
                    {{--                    <input type="text" class="form-control" name="PhoneNumber"   value="{{$quote->phone_number}}"  placeholder="Phone Number" disabled="disabled"/>--}}
                    <a id="phone" class="btn helep_btn_raise"
                       href="tel:{{$quote->phone_number}}">Contact Requester
                    </a>

                </div>

            </div>
            <hr>
            <div class="col-12 col-sm-12 mb-2 border-bottom">
                <label>Description</label>
                <p class="text-black">{{$quote->description}}</p>
                {{--            <textarea class="form-control html-editor" rows="5" name="Description" required placeholder="Description">  {{$quote->description}}</textarea>--}}
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
