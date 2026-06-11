@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Resultado Verificación de Cuenta Transacción Completa Estándar Marca sin CVV</h1>
    <p class="text-gray-700 mb-6">
        Revisa la respuesta de la verificación de cuenta estándar marca sin CVV.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Request</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Response</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($res, true) }}</pre>
        </div>
    </div>
</div>
@endsection
