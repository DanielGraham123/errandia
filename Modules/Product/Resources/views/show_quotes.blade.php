@extends('helep.vendor.layout.master')
@section('title') Product Quote List @endsection
@section('content')
    <div class="container">
        @if(sizeof($quotes)):
        <div class=" row">
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul id="product-details-tab" class="nav nav-justified nav-fill fit-content"
                    role="tablist">
                    <li class="nav-item active p-0">
                        <a class="nav-link withoutripple" href="{{route('product_quote_list')}}">
                            <span class="font-weight-bold">Quotes</span>
                        </a>
                    </li>
                    <li class="nav-item p-0">
                        <a class="nav-link withoutripple" href="{{route('show_deleted_quotes')}}">
                            <span class="font-weight-bold">Trash</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content py-4">
                    {{--             description           --}}
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
                                        <td><a href="{{url('products/quote-details/'.$quote->id)}}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

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
        @else:
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-center flex-column">
                    <h5>No quote found</h5>
                    <a href="{{route('show_deleted_quotes')}}" class="btn btn-primary text-normal">View trash</a>
                </div>
            </div>
        </div>

        @endif
    </div>

    <style>
        @media (max-width: 574px ) {
            .img-caroul {
                max-width: 200px !important;
            }
        }


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
