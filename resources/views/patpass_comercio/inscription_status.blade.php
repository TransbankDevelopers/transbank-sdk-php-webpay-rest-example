@extends('layout')
@section('pageClass', 'result-page')
@section('content')
    <h1> Ejemplo Patpass Comercio - Status</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($params, true) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($response, true)  }}
</pre>

<form method="post" action={{  $response->getUrlVoucher() }}>
    <input type="text" name="tokenComercio" value={{ $params["tokenComercio"] }} />

    <button type="submit">Obtener Voucher</button>
</form>

@endsection

