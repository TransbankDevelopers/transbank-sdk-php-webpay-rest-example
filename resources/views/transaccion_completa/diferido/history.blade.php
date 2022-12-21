@extends('layout')
@section('content')
<h1>Transacción Completa Diferida historial de transacción</h1>

<h2>Request</h2>
<pre> {{  print_r($req, true) }} </pre>

<h2> Response </h2>
<pre> {{  print_r($res, true) }} </pre>


@endsection
