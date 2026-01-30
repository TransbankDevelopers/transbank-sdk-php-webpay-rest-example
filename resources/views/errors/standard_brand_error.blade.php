@extends('layout')
@section('content')
    <div class="error-card">
        <h2 class="error-title error-title--standard">Error en Transacción Completa Standard Brand</h2>
        <p class="error-text error-text--standard">No se pudo completar la operación.</p>
        <p class="error-text error-text--standard error-text--method"><strong>Método que falló:</strong>
            {{ $action ?? 'N/A' }}</p>

        <div class="error-detail error-detail--standard">
            <strong>Acción:</strong> {{ $action ?? 'N/A' }}<br>
            <strong>Código:</strong> {{ $status ?? 500 }}<br>
            <strong>Mensaje:</strong> {{ $message ?? 'Error inesperado' }}
        </div>

        @if (!empty($req))
            <h4 class="error-text error-text--standard">Parámetros enviados</h4>
            <pre class="error-pre error-pre--standard">{{ print_r($req) }}</pre>
        @endif

        <div class="error-actions">
            <a href="{{ url()->previous() }}" class="error-back error-back--standard">Volver</a>
        </div>
    </div>
@endsection
