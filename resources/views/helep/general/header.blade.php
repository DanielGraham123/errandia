<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="ERRANDIA- Online Ecommerce platform to help run your errands for you technologically by reaching out to all goods and service provides through a distinct search algorithm
           | search service providers near you | shop online for all kind of products and services| Online Shop Cameroon| Errandia stores| ">
    <meta name="copyright"
          content=" ERRANDIA - Connecting service providers, shops, businesses to customers, buyers with a single intelligent search algorithm ">
    <meta name="keywords"
          content="'ERRANDIA','Online Ecommerce 'Buy products online','Stores near me in Cameroon','Stores in Buea', 'Stores in Douala','Online Stores Cameroon','Best prices Cameroon','search service providers near you',
          'Search products online','Online Shopping','Shop Online Cameroon','Errandia Stores','Products on Errandia'">
    <meta name="google-site-verification" content="xcVBsPJCBmIKnmvyoIXtqKy5VL3KIsERRV0BUx179_A" />      
    <meta name="robots">
          
    @yield('meta')
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <title>{{config('app.name')}} - @yield('page_title')</title>
    <link href="{{asset('css/plugins.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.light-blue-500.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/helep.css')}}" rel="stylesheet">
    @yield('css')
    <style>
    ::-webkit-scrollbar {
    width: 7px;
  }
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px transparent !important;
    border-radius: 10px;
  }
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #113d6b;
    border-radius: 10px;
  }
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #113d6b;
  }
    </style>
</head>

<body class="fix-header card-no-border" style="overflow-x: hidden !important">
<input type="hidden" id="baseUrl" value="{{url('/')}}"/>
@include('helep.general.search_bar')
@include('helep.general.components.modals')
