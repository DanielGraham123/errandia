@extends('helep.buyer.layout.master')
@section('page_title') @lang('buyer.buyer_sidebar_reviews_history_msg') @endsection
@section('title') @lang('buyer.buyer_sidebar_reviews_history_msg') @endsection
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
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
        </div>
        <table id="userReviews" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
            <tr>
                <th>S/N</th>
                <th>@lang('buyer.buyer_placeholder_product')</th>
                <th>@lang('buyer.buyer_placeholder_rating')</th>
                <th style="width:300px;">@lang('buyer.buyer_placeholder_review')</th>
                <th>@lang('buyer.buyer_placeholder_date')</th>
                <th>@lang('buyer.buyer_placeholder_action')</th>
            </tr>
            </thead>
            <tbody>
            @php $counter=1; @endphp
            @foreach ($reviews as $review)
                <tr>
                    <td>{{$counter++}}</td>
                    <td><a target="_blank"
                           href="{{route('general_product_details',['id'=>$review->slug])}}">{{$review->product_name}}</a>
                    </td>
                    <td>
                        <div class="Stars" style="--rating: {{$review->rating}};--star-color:#a1abbd;"
                             aria-label="Rating of this product is 2.3 out of 5."></div>
                    </td>
                    <td>
                        <div
                            style="white-space: normal"><?php echo $review->review;?></div>
                    </td>
                    <td>{{convert_date_to_human($review->date)}}</td>
                    <td>
                        @if($review->review_status !=1)
                            <a class="btn btn-primary">@lang('buyer.buyer_placeholder_hidden_msg')</a>
                        @else
                            <a id="{{$review->review_id}}" onclick="showUpdateReviewModal(this)"
                               rel="{{$review->review}}" class="text-muted p-1 m-1"><i
                                    class=" fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                            <a href="{{route('delete_customer_reviews',['id'=>$review->review_id])}}"
                               class="text-muted"><i
                                    class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
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
    <div class="modal modal-primary" id="updateReviewDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header helep-color">
                    <h3 class="modal-title" id="myModalLabel">Update Review</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <div id="errorMessage"></div>
                    <div class="row">
                        <div class="col-md-8 form-group">
{{--                            <input class="form-control" type="text" name="review" placeholder="Enter Product Review"--}}
{{--                                   id="selectedReview">--}}
                            <textarea  id="selectedReview" class="form-control  html-editor" name="review"
                                      ></textarea>
                            <input type="hidden" id="selectedReviewId" value=""/>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button onclick="updateReview(this)" id="updateReviewBtn" type="button" class="btn helep_btn_raise">
                        Save
                        changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("css")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('js')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(function () {
            //set link indicator
            $("#buyer_sidebar_manage_product_reviews").addClass('active');
            $('#userReviews').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });

        function showUpdateReviewModal(obj) {
            var review_id = obj.id;
            var review = obj.rel;
            $("#selectedReview").val(review);
            $("#selectedReviewId").val(review_id);
            $("#updateReviewDialog").modal('show');
        }

        function updateReview() {
            $("#updateReviewBtn").prop('disabled', true);
            var reviewId = $("#selectedReviewId").val();
            var review = $("#selectedReview").val();
            if (review === "") {
                alert("Kindly enter a review for the product to update");
                return;
            }
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                datatype: "json",
                type: 'post',
                data: {
                    review: review,
                },
                url: $("#baseUrl").val() + '/customers/reviews/' + reviewId,
                success: function (response) {
                    //console.log(JSON.parse(response));
                    $("#updateReviewDialog").modal('hide');
                    window.location.reload();
                },
                error: function (err) {
                    console.log(err);
                    $("#errorMessage").html("<p class='alert alert-danger'>An error occured while updating user review. Please try again</p>");
                }
            });
        }
    </script>
@endsection
