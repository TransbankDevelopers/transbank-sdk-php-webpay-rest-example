@extends('layout')
@section('content')
    <h1>Oneclick Mall Transaction Status</h1>

<h1>Request</h1>
<pre> {{  print_r($req, true) }} </pre>

<h1>Response</h1>
<pre> {{  print_r($resp, true) }} </pre>
@endsection
