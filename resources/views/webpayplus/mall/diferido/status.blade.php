@extends('layout')
@section('content')
    <h1> Ejemplo Webpay Plus Mall Status </h1>


    <div class="request">
        <h4> Request </h4>
       <pre>{{  print_r($req, true) }}</pre>
   </div>
   <div class="response">
       <h4> Respuesta </h4>
       <pre>{{  print_r($resp, true) }}</pre>
   </div>
@endsection
