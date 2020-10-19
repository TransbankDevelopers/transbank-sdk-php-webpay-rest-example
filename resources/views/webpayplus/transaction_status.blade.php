@extends('layout')
@section('content')
    <a href="#" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Volver</a>

    <h1> Status de la transacción Webpay plus</h1>
    <div class="request">
         <h4> Request </h4>
        <pre>{{  print_r($req, true) }}</pre>
    </div>
    <div class="response">
        <h4> Respuesta </h4>
        <pre>{{  print_r($resp, true) }}</pre>
    </div>
@endsection
