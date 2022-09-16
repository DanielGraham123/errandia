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
    	<h3>Product List</h3>
        <div class="d-flex justify-content-between">        	
            <div class="d-flex flex-wrap">
            	<a href="{{route('products')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
                
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        	<tr>
            	<th>Product Name</th>
                <th>Image</th>                
                <th  style="width:300px;">Description</th>
                <th>Action</th>
            </tr>            
            @foreach ($products as $product)
            <tr>
            	 <td><a href="{{route('show_product',['id'=>$product->slug])}}">{{$product->name}}</a></td>
                <td><img style="max-height:200px; max-width: 200px" height="200px" width="200px" src="{{url('storage/'.$product->featured_image_path)}}" class="card-img-top" alt="..."></td>
                <!--<td><div class="Stars" style="--rating: {{$product->rating}};--star-color:#a1abbd;" aria-label="Rating of this product is 2.3 out of 5."></div></td>-->
                <td><div style="line-height: 1.5em;height: 3em;overflow: hidden;"><?php echo substr($product->description,0,100);?></div>...</td>
                <td><a class="btn btn-info" href="{{url('products/review-details/'.$product->id)}}">View All Reviews</a></td>
            </tr>
            @endforeach
        </table>
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
jQuery(document).ready(function() {
var table = jQuery('#example').DataTable( {
responsive: true
} );

new jQuery.fn.dataTable.FixedHeader( table );
} );
    </script>
@endsection
