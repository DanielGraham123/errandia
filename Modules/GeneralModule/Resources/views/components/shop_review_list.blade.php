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

    .chat {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        color: #000;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .chat::after {
        content: "";
        clear: both;
        display: table;
    }

    .time-right {
        float: right;
        color: #000;
        font-size: 12px;
    }

    .time-left {
        float: left;
        color: #000;
        font-size: 12px;
    }

    .chat .imgdiv {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
        height: 65px;
        border: 1px solid;
        background: #113d6b;
        padding: 15px;
        color: #fff;
        font-weight: bold;
    }

    .chat .imgdivright {
        float: right;
        margin-left: 20px;
        margin-right: 0;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
        height: 65px;
        border: 1px solid;
        background: #113d6b;
        padding: 18px;
        color: #fff;
        font-weight: bold;
        font-size: 12px;
        padding-top: 17px;
    }

    .enquiryaccordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
        margin-bottom: 10px;
    }

    .enquiryactive, .enquiryaccordion:hover {
        background-color: #ccc;
    }

    .enquiryaccordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .enquiryactive:after {
        content: "\2212";
    }

    .panelSlider {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }

    .username {
        float: left;
        font-style: italic;
        font-weight: bold;
    }

    .title {
        float: left;
        width: 80%;
    }
</style>
<br/>
@foreach($reviews as $review)
<div class="Stars" style="--rating: {{$review->rating}};--star-color:#a1abbd;"
     aria-label="Rating of this product is 2.3 out of 5."></div>
<div><h5 class="mt-0 mb-1 text-black-50">{{$review->product_name}}</h5></div>
<div class="clearfix mb-1"></div>
<div>
    <?php $reviewImageList= $reviewImages->where('review_id', $review->review_id); ?>
    @foreach($reviewImageList as $image)
        <img height="80" width="95" class="rounded "
             src="{{asset('storage/'.$image->image_path)}}"
             alt="{{$review->product_name}}" style="width:120px;max-width: 120px;max-height: 100px">
    @endforeach
</div>
<div> {!!$review->review!!} </div>
<div class="clearfix"></div>
<div style="font-size:12px;"><i>Reviewed on {{$review->review_date}}</i> By
    <small><b>{{$review->user_name}}</b></small></div>
@endforeach
