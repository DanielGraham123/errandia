@extends('helep.vendor.layout.master')
@section('content')
    <div class="container">
    	<h3>Product Enquiries List</h3>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap"><a href="{{route('products')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                </a>
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        	<tr>
                <th>Product</th>
                <th>User</th>
                <th>Title</th>
                <th style="width:300px;">Description</th>
                <th>Action</th>
            </tr>
            @foreach ($enquiries as $enquiry)
            <tr>
                <td>{{$enquiry->ProductName}}</td>
                <td>{{$enquiry->UserName}}</td>
                <td>{{$enquiry->title}}</td>
                <td><div style="white-space: normal "><?php echo $enquiry->description;?></div>...</td>
                <td><a class="btn btn-info" href="{{url('products/enquiry-details/'.$enquiry->id)}}">Details</a></td>
            </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {{ $enquiries->links() }}
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
            $("#vendor_sidebar_manage_product_enquiry").addClass('active');
        });
jQuery(document).ready(function() {
var table = jQuery('#example').DataTable( {
responsive: true
} );

new jQuery.fn.dataTable.FixedHeader( table );
} );
    </script>
@endsection
