@extends('layout')
@section('content')
    <h1>Inscripción borrada exitosamente</h1>

<h2>Request</h2>
<pre> {{  print_r($req, true) }} </pre>


<h2>Response</h2>
<pre> {{  print_r($resp, true) }} </pre>
@endsection
