<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <title>{{config('app.name')}} - @yield('page_title')</title>
    <link href="{{asset('css/plugins.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.light-blue-500.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/helep.css')}}" rel="stylesheet">
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body class="fix-header card-no-border fix-sidebar">
<input type="hidden" id="baseUrl" value="{{url('/')}}"/>
<div class="d-flex flex-wrap bg-white flex-sm-nowrap">
