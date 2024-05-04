<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>{!! $title ?? '' !!} | {{env('APP_NAME')}}</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>

    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style"/>
    <link rel="stylesheet" href="{{asset('assets/css/ace-part2.min.css')}}" class="ace-main-stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}"/>


    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css')}}"/>


    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" class="ace-main-stylesheet" id="main-ace-style"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('libs')}}/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{ asset('tel_input_build/css/intlTelInput.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"/>
    {{--
    <link rel="stylesheet" href="{{asset('richtexteditor/rte_theme_default.css')}}"/>
    <script type="text/javascript" src="{{asset('/richtexteditor/rte.js')}}"></script>
    <script type="text/javascript" src="{{asset('/richtexteditor/plugins/all_plugins.js')}}"></script>
    --}}

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: 'textarea#text-editor1'});</script>


    @php
    $bg1 = 'white';
    $bg2 = '#113d6b';
    $bg3 = '#091f36';
    @endphp
    <STYLE>
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* filter: brightness(105%); */
        }

        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }

        .dt-button {
            background-image: none !important;
            border: 1px solid #FFF;
            border-radius: 0;
            padding: 5px 20px;
            border-radius: 5px;
            box-shadow: none !important;
            -webkit-transition: background-color .15s, border-color .15s, opacity .15s;
            -o-transition: background-color .15s, border-color .15s, opacity .15s;
            transition: background-color .15s, border-color .15s, opacity .15s;
            vertical-align: middle;
            margin: 0;
            position: relative;
        }


    </STYLE>

</head>