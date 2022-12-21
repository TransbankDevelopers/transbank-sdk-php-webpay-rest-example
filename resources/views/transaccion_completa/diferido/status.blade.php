@extends('layout')
@section('content')
<h1> Ejemplo Transacción Completa Diferida Status</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>

<br>
<a href="/"><h1>Volver</h1></a>
@endsection
