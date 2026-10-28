@extends('layout')
@section('content')
<h1>Webpay Mall Monotienda - Bines Estado de Transacción</h1>

<h3>Request</h3>
<pre> {{  print_r($req, true) }} </pre>
<h3>Response</h3>
<pre> {{  print_r($resp, true) }} </pre>
@endsection
