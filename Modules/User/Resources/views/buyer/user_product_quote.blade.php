@extends('helep.buyer.layout.master')
@section('page_title') @lang('buyer.buyer_quotes_list_title') @endsection
@section('title') @lang('buyer.buyer_quotes_list_title') @endsection
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
                <th>S/N</th>
                <th>@lang('buyer.buyer_placeholder_title')</th>
                <th>@lang('buyer.buyer_placeholder_description')</th>
                <th>@lang('buyer.buyer_placeholder_date')</th>
            </tr>
            @php $counter=1; @endphp
            @foreach ($quotes as $quote)
                <tr>
                    <td>{{$counter++}}</td>
                    <td>{{$quote->title}}</td>
                    <td>{{$quote->description}}</td>
                    <td>{{convert_date_to_human($quote->date)}}</td>
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
            $("#buyer_sidebar_manage_errands").addClass('active');
        });
    </script>
@endsection
