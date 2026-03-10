@extends('layout')
@section('content')
    <div class="error-card error-card--general">
        <h2 class="error-title error-title--general">Ocurrió un error inesperado</h2>
        <p class="error-text error-text--general">Intenta nuevamente o revisa los datos enviados.</p>

        <div class="error-detail error-detail--general">
            <strong>Acción:</strong> {{ $action ?? 'N/A' }}<br>
            <strong>Código:</strong> {{ $status ?? 500 }}<br>
            <strong>Mensaje:</strong> {{ $message ?? 'Error inesperado' }}
        </div>

        @if (!empty($req))
            <h4 class="error-text error-text--general">Parámetros enviados</h4>
            <pre class="error-pre error-pre--general">{{ print_r($req, true) }}</pre>
        @endif

        <div class="error-actions">
            <a href="{{ url()->previous() }}" class="error-back error-back--general">Volver</a>
        </div>
    </div>
@endsection
