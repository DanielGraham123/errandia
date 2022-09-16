@extends('helep.general.master')

@section('content')
    <div class="py-5 container">
        <div class="ml-lg-n2 mr-lg-n5">
            <div class="row card helep_alert_round">                
                <div class=" card-body col-md-12">
                <div class="p-2 m-2">
                <h4 class="helep-text-color font-weight-bold  pb-2 mb-2">
                Regions       </h4>
                </div>
                    @foreach ($regions as $region) 
                    <div class="text-black-50 font-weight-bold col-md-3" style="float:left !important;">
                        <a href="{{route('regions_stores',['id' => $region->id])}}">{{ $region->name }}</a>                        
                    </div>
                    @endforeach                    
                </div>
            </div>
        </div>
    </div>
@endsection
