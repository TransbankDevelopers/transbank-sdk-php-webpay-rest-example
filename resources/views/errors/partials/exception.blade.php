{{--
    Detalle de una excepción. Recibe los datos de App\Support\ExceptionViewData::from().
    El mensaje se muestra tal cual: en esta app de prueba es la información más útil para quien la usa.
--}}
@php
    $json = function ($value) {
        return is_string($value) ? $value : json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    };
@endphp
<div class="exception-page">
    <p class="exception-page__status">
        <span class="exception-page__badge">Error {{ $status }}</span>
    </p>
    <h1 class="exception-page__title">{{ $title }}</h1>
    @if ($action)
        <p class="exception-page__action">Operación: <code>{{ $action }}</code></p>
    @endif

    <div class="exception-page__message" role="alert">
        <span class="exception-page__label">Mensaje de la excepción</span>
        <p class="exception-page__message-text">{{ $message }}</p>
    </div>

    @if ($failedRequest)
        <section class="exception-page__section">
            <h2 class="exception-page__section-title">Petición a Transbank</h2>
            <p class="exception-page__request-line"><code>{{ $failedRequest['method'] }} {{ $failedRequest['url'] }}</code></p>
            @if (!empty($failedRequest['payload']))
                <pre class="exception-page__code">{{ $json($failedRequest['payload']) }}</pre>
            @endif
        </section>
    @endif

    @if (!empty($req))
        <section class="exception-page__section">
            <h2 class="exception-page__section-title">Parámetros enviados</h2>
            <pre class="exception-page__code">{{ $json($req) }}</pre>
        </section>
    @endif

    <div class="exception-page__actions">
        <a class="tbk-btn-link exception-page__primary" href="{{ url()->previous() }}">Volver</a>
        <a class="exception-page__secondary" href="{{ url('/home') }}">Ir al inicio</a>
    </div>
</div>
