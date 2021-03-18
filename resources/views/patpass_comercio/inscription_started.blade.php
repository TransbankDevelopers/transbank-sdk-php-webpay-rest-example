@extends('layout')
@section('content')
    <h1> Ejemplo Patpass Comercio</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($params) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($response)  }}
</pre>

<form method="post" action={{  $response->getUrlWebpay() }}>
    <input type="text" name="tokenComercio" value={{ $response->getToken() }} />

    <button type="submit">Enviar datos</button>
</form>
@endsection



