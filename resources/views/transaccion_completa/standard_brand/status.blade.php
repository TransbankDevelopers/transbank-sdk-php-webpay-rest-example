@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Estado de Transacción Completa Estándar Marca</h1>
    <p class="text-gray-700 mb-6">
        Revisa el estado actualizado de la transacción estándar marca.
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

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h2 class="text-base font-bold text-blue-900 mb-2">Token</h2>
        <input type="text" readonly value="{{ $req['token'] }}" class="w-full bg-white" />
    </div>
</div>
@endsection
