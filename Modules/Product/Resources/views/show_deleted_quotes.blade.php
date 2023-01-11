@extends('helep.vendor.layout.master')
@section('title') Deleted Product Quote List @endsection
@section('content')
    <div class="container">
        <h3></h3>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap">
            </div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <div class=" row">
            <div class="col-md-12">

                <!-- Nav tabs -->
                <ul id="product-details-tab" class="fit-content nav nav-justified nav-fill"
                    role="tablist">
                    <li class="nav-item p-0">
                        <a class="nav-link withoutripple" href="{{route('product_quote_list')}}">
                            <span class="font-weight-bold">Quotes</span>
                        </a>
                    </li>
                    <li class="nav-item active p-0">
                        <a class="nav-link withoutripple" href="{{route('show_deleted_quotes')}}">
                            <span class="font-weight-bold">Trash</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content py-4">
                    <div role="tabpanel" class="tab-pane fade active show" id="description">
                        <div class="position-relative" style="overflow-x: scroll; padding: 10px 0">
                            <table class="w-100 quote-table">
                                <thead class="sr-only">
                                    <th>Title and description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach ($quotes as $quote)
                                    <tr class="@if($quote->read_status) read @else unread @endif"
                                        data-url="{{url('products/quote-details/'.$quote->id)}}">
                                        <td class="quote-title" role="gridcell" tabindex="-1">
                                            <div>
                                                <h5>
                                                    {{ \Illuminate\Support\Str::words($quote->title, 10,'...')}}
                                                </h5>
                                                <p style="font-size: 13px">
                                                    {{ \Illuminate\Support\Str::words(strip_tags($quote->description), 15,'...')}}
                                                </p>

                                            </div>
                                        </td>
                                        <td class="quote-time" role="gridcell" tabindex="-1">
                                            <div>{{ \Carbon\Carbon::parse($quote->created_at)->toFormattedDateString() }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="{{ route('restore_deleted_quote', $quote->id) }}" title="Restore quote" class="mr-4 mb-sm-3 mb-md-0">
                                                    <i class="fa fa-window-restore text-success  fa-lg"></i>
                                                </a>
                                                <a href="{{ route('delete_quote_permanently', $quote->id) }}" title="Permanently delete" class="mb-sm-3 mb-md-0">
                                                    <i class="fa fa-trash text-danger fa-lg"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--                                    <div class="text-justify font-16 text-black">--}}
                        {{--                                        <div class="quote-tile"></div>--}}

                        {{--                                    </div>--}}
                    </div>
                    {{--              reviews          --}}
                    <div role="tabpanel" class="tab-pane fade" id="reviews">
                        <div>Unread</div>
                    </div>
                    {{--               enquiries         --}}
                    <div role="tabpanel" class="tab-pane fade" id="enquiry">
                        <div>Read</div>
                    </div>
                </div>
                <!-- card -->
            </div>
        </div>

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

        /*#product-details-tab .nav-item:hover, #product-details-tab .nav-item.active {*/
        /*    background-color: #fff !important;*/
        /*    border-radius: 0 !important;*/
        /*    cursor: pointer;*/
        /*}*/

        /*#product-details-tab .nav-item:hover a, #product-details-tab .nav-item.active a {*/
        /*    color: #113d6b !important;*/

        /*}*/

        /*#product-details-tab .nav-item a:hover {*/
        /*    background-color: transparent !important;*/
        /*    color: #113d6b !important;*/
        /*}*/

        /*   gmail style */
        table.quote-table tr {
            /*border-bottom: 1px rgba(100, 121, 143, 0.122) solid;*/
            border-top: 1px rgba(100, 121, 143, 0.122) solid;
            height: 50px;
            padding: 10px 5px;
        }
        table.quote-table tbody tr{
            cursor: pointer;
        }



        table.quote-table tbody tr:hover {
            box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgb(60 64 67 / 30%), 0 1px 3px 1px rgb(60 64 67 / 15%);
            z-index: 2;
        }

        table.quote-table tr.unread {
            color: #202124;
        }

        table.quote-table tr.unread div {
            font-weight: 500;
        }

        table.quote-table tr.read {
            background: #f2f6fc;
            color: #202124;
        }

        table.quote-table td ,table.quote-table th{
            padding: 0 10px;
        }
        table.quote-table thead{
            background: #000;
        }

        /*.quote-table .quote-title {*/
        /*    width: 25%;*/
        /*}*/

        /*.quote-table .quote-time {*/
        /*    width: 12%;*/
        /*}*/

        /*.xY {*/
        /*    border-bottom: 1px rgba(100, 121, 143, 0.122) solid;*/
        /*    empty-cells: show;*/
        /*    height: 50px;*/
        /*    outline: none;*/
        /*    padding: 0;*/
        /*    vertical-align: middle;*/
        /*    white-space: nowrap;*/
        /*}*/

        /*.zA > .a4W {*/
        /*    -webkit-font-smoothing: antialiased;*/
        /*    font-family: "Google Sans", Roboto, RobotoDraft, Helvetica, Arial, sans-serif;*/
        /*    font-size: .875rem;*/
        /*    letter-spacing: normal;*/
        /*    display: -webkit-box;*/
        /*    display: -webkit-flex;*/
        /*    display: flex;*/
        /*    -webkit-box-flex: 1 1 auto;*/
        /*    -webkit-flex: 1 1 auto;*/
        /*    flex: 1 1 auto;*/
        /*    height: auto;*/
        /*    min-width: 0;*/
        /*    padding-right: 10px;*/
        /*}*/

        /*.zA > .xY {*/
        /*    -webkit-align-items: center;*/
        /*    align-items: center;*/
        /*    border: none;*/
        /*    display: -webkit-box;*/
        /*    display: -webkit-flex;*/
        /*    display: flex;*/
        /*    -webkit-box-flex: 0 0 auto;*/
        /*    -webkit-flex: 0 0 auto;*/
        /*    flex: 0 0 auto;*/
        /*    line-height: 20px;*/
        /*    -webkit-box-ordinal-group: 1;*/
        /*    -webkit-order: 1;*/
        /*    order: 1;*/
        /*    padding: 0;*/
        /*}*/

        /*.a4W {*/
        /*    -webkit-flex-wrap: wrap;*/
        /*    flex-wrap: wrap;*/
        /*}*/

    </style>
@endsection



@section('js')
    <script>
        $(function () {
            //set link indicator
            $("#vendor_sidebar_manage_product_quote").addClass('active');
            $(document).on('click', 'table.quote-table tbody tr', function () {
                console.log("i was cliked")
                let route = $(this).attr("data-url");
                window.location.href = route;
            });
        });
        jQuery(document).ready(function () {
            // var table = jQuery('#example').DataTable({
            //     responsive: true
            // });


            // new jQuery.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
