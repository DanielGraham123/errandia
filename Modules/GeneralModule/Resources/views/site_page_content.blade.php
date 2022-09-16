@extends('helep.general.master')
@section('page_title'){{$pageTitle}} @endsection
@section('content')
    <div class="py-5 container-lg">
        <div class="ml-n2 mr-n5">
            <div class="card helep_round">
                @if(session('message'))
                    <div class="alert alert-success">{!! session('message') !!}</div>
                @endif
                <div class="card-body row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="mb-2 m-lg-2 p-lg-2" style="text-align: justify;font-family: sans-serif">
                            {!! $pageContent !!}
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
