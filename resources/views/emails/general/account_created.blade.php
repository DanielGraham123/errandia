@component('mail::message')
    <?php $user_name = explode(" ", $user->name); $user_first_name = $user_name[0]; ?>
    <b>Hi {{$user_first_name}}</b>,
    <br/><br/>
    <span>@lang("general.email_account_created_welcome")</span>
    <br/>
    <p>@lang("general.email_account_created_h2").</p>
    <p>@lang("general.email_account_created_p").</p>
    @component('mail::button', ['url' => route('login_page')])
        @lang("general.email_account_created_login_btn")
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

