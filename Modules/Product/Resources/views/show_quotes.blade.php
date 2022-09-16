@extends('helep.vendor.layout.master')
@section('title') Product Quote List @endsection
@section('content')
    <div class="container">
        <h3></h3>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap">
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
            <tr>
                <th>Title</th>
                <th>Phone Number</th>
                <th>Description</th>
                <th>Action</th
                <th></th>
            </tr>
            @foreach ($quotes as $quote)
                <tr>
                    <td>{{$quote->title}}</td>
                    <td>{{$quote->phone_number}}</td>
                    <td>{{$quote->description}}</td>
                    <td><a class="btn btn-info" href="{{url('products/quote-details/'.$quote->id)}}">Details</a></td>
                    <td>
                        <a id="phone" class="btn helep_btn_raise"
                           href="tel:{{$quote->phone_number}}">Contact Requester
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {{ $quotes->links() }}
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
            $("#vendor_sidebar_manage_product_quote").addClass('active');
        });
        jQuery(document).ready(function () {
            var table = jQuery('#example').DataTable({
                responsive: true
            });

            new jQuery.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
