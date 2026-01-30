@extends('layout')
@section('content')
    <h1>Resultado Verificación de Cuenta - Transacción Completa Standard Brand</h1>

    <h3>Parámetros recibidos:</h3>
    <pre>
    {{ print_r($req) }}
</pre>

    <h3>Respuesta:</h3>
    <pre>
    {{ print_r($res) }}
</pre>
@endsection
