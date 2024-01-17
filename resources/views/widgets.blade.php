@extends('public.layout')
@section('section')
    <div class="container">
        {{-- searchable multiselect --}}
        <select class="form-select form-control border" id="multiple-select-field1" data-placeholder="Choose anything" multiple>
            <option>Christmas Island</option>
            <option>South Sudan</option>
            <option>Jamaica</option>
            <option>Kenya</option>
            <option>French Guiana</option>
            <option>Mayotta</option>
            <option>Liechtenstein</option>
            <option>Denmark</option>
            <option>Eritrea</option>
            <option>Gibraltar</option>
            <option>Saint Helena, Ascension and Tristan da Cunha</option>
            <option>Haiti</option>
            <option>Namibia</option>
            <option>South Georgia and the South Sandwich Islands</option>
            <option>Vietnam</option>
            <option>Yemen</option>
            <option>Philippines</option>
            <option>Benin</option>
            <option>Czech Republic</option>
            <option>Russia</option>
        </select>
    </div>
@endsection
@section('script')
    <script>
        $( '#multiple-select-field1' ).select2( {
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
@endsection