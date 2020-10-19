@extends('layout')
@section('content')
    <a href="#" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Volver</a>
    
    <h1>Webpay Plus Anulacion exitosa!</h1>


    <pre>{{ print_r($resp, true)  }}</pre>
@endsection
