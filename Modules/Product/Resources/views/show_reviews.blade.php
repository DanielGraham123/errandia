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
            background: linear-gradient(90deg, var(--star-background) var(--percent), var(--star-color) var(--percent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <div class="container">
        <h3>Product Review List</h3>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap">
                <a href="{{route('products')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
                <a href="{{route('product_list')}}">
                    <button type="button" class="btn helep_btn_raise">
                        Product List
                    </button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
            <tr>
                <th>Product</th>
                <th>User</th>
                <th>Rating</th>
                <th style="width:300px;">Review</th>
                <th>Action</th>
            </tr>
            @foreach ($reviews as $review)
                <tr>
                    <td><a href="{{route('show_product',['id'=>$review->slug])}}">{{$review->product_name}}</a></td>
                    <td>{{$review->user_name}}</td>
                    <td>
                        <div class="Stars" style="--rating: {{$review->rating}};--star-color:#a1abbd;"
                             aria-label="Rating of this product is 2.3 out of 5."></div>
                    </td>
                    <td>
                        <div
                            style="white-space: normal"><?php echo $review->review;?></div>
                        ...
                    </td>
                    <td>
                        <a class="btn btn-info"
                           href="{{url('products/review-details/'.$review->review_id)}}">Details</a>
                        @if($review->review_status ==1)
                        <a class="btn btn-danger" href="{{route('hide_product_review',['id'=>$review->review_id])}}">Hide
                            Review</a>
                        @else
                           <a class="btn btn-primary">Hidden</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {{ $reviews->links() }}
            </div>
            <div class="col-md-2"></div>
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
        jQuery(document).ready(function () {
            var table = jQuery('#example').DataTable({
                responsive: true
            });

            new jQuery.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
