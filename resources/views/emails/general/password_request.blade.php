@component('mail::message')
    <?php $user_name = explode(" ", $user->name); $user_first_name = $user_name[0]; ?>
    <b>Hi {{$user_first_name}}</b>,
    <br/><br/>
    <span>@lang("general.email_account_password_reset_h2")</span>
    <br/>
    <small>@lang("general.email_account_password_reset_span")</small>
    <br/>
    <p>@lang("general.email_account_password_reset_instruction")</p>
    @component('mail::button', ['url' => route('password_reset_link',['ref'=>$slug])])
        @lang("general.reset_password_title_msg")
    @endcomponent
    @component('mail::panel')
        @lang("general.email_account_created_disclaimer") {{config('app.url')}}
        @component('mail::subcopy')
            @lang("general.email_support_msg")<a style="color:#007bff" href="mailto:info@errandia.cm">info@errandia</a>
        @endcomponent
    @endcomponent
    @lang("general.footer_motto_email")!
    Errandia Support Team.
@endcomponent

