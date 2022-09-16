@component('mail::message')
    <?php $quoteInfo = $quote['quote']; $link = $quote['link'] ?>
    <b>Hi there!</b>,
    <br/>
    <p>@lang("general.product_quote_email_msg").</p>
    <div style="box-shadow:0 0.5rem 1rem rgba(0, 0, 0, .175) !important; border-radius: .5em;">
        <span>@lang("general.errands_email_title_body")</span>
        <p><b>{{$quoteInfo->title}}.</b></p><br/>
        <img alt="{{$quoteInfo->title}}" height="80" width="95" style="border-radius: 6px;"
             src="{{asset('storage/'.$quoteInfo->image->image_path)}}"/>
    </div>
    <p>  @lang("general.product_quote_email_link_msg")</p>
    @component('mail::button', ['url' =>$link])
        @lang("general.product_quote_email_link_btn_msg")
    @endcomponent
    @component('mail::panel')
        @lang("general.email_account_created_disclaimer") {{config('app.url')}}
        @component('mail::subcopy')
            @lang("general.email_support_msg")<a style="color:#007bff"
                                                 href="mailto:info@errandia.cm">info@errandia.cm</a>
        @endcomponent
    @endcomponent
    @lang("general.footer_motto_email")!
    Errandia Support Team.
@endcomponent

