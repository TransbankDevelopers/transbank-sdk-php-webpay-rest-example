@extends('layout')
@section('content')
<h1> Ejemplo Transacción Completa Mall Status </h1>

<h3>Parametros recibidos:</h3>
<pre>
    Token: {{ $token }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res, true)  }}
</pre>
@endsection
