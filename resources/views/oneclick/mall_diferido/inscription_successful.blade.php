@extends('layout')
@section('content')
    <h1>Oneclick Mall Inscripción realizada</h1>


<h3>Datos de la respuesta</h3>
<pre> {{  print_r($resp, true) }} </pre>

<h3>Enviar datos a Transbank</h3>
<form method="post" action={{ $resp->getUrlWebpay() }}>
    <label for id="tbk_token">TBK_TOKEN: {{ $resp->getToken() }}</label>
    <input type="text" name="TBK_TOKEN" value="{{ $resp->getToken() }}">


    <button type="submit">Enviar datos</button>
</form>


@endsection
