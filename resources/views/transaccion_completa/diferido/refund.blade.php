@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transacción Completa Diferida: refund</h1>
    <p class="text-gray-700 mb-6">
        Resultado de la solicitud de reembolso para la transacción diferida.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Parámetros recibidos</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Respuesta</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($res, true) }}</pre>
        </div>
    </div>

    <a class="tbk-btn-link" href="{{ route('completa.diferido.index') }}">Volver</a>
</div>
@endsection
