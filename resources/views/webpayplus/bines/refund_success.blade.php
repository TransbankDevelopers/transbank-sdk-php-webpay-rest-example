@extends('layout')
@section('content')
    <a href="#" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Volver</a>

    @if(!$error)
        <h1>Webpay Plus - Bines: anulación exitosa</h1>
    @else
        <h1>Webpay Plus - Bines: anulación con errores</h1>
    @endif

    <pre>{{ print_r($resp, true)  }}</pre>
@endsection
