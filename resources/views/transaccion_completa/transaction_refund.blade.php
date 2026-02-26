@extends('layout')
@section('content')
<h1> Ejemplo Transacción Completa Refund</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>

<br>
<a href="/transaccion_completa/create"><h1>Volver</h1></a>
@endsection
