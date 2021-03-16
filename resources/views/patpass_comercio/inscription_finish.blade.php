@extends('layout')
@section('content')
    <h1> Ejemplo Patpass Comercio</h1>

<h3>Obtener Status:</h3>
<pre>
  {{ $req["j_token"] }}
</pre>

<form method="post" action="/patpass_comercio/status">
    @csrf
    <input name="tokenComercio" type="text" value="{{ $req["j_token"] }}"/>

    <button type="submit">Obtener Status</button>
</form>

@endsection
