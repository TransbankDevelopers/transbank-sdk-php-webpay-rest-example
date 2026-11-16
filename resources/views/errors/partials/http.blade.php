{{--
    Errores HTTP que resuelve Laravel (errors/{código}), con el mismo estilo que la pantalla de excepciones.
    Si la excepción trae su propio mensaje (p. ej. abort(403, '...')), se muestra ese.
--}}
@php
    $defaults = [
        403 => ['No tienes acceso a esta página', 'No tienes permiso para ver este recurso.'],
        404 => ['Página no encontrada', 'La dirección no existe o cambió.'],
        405 => ['Método no permitido', 'Esta dirección no acepta este tipo de petición. Vuelve al formulario e inténtalo de nuevo.'],
        419 => ['La sesión expiró', 'El formulario estuvo abierto demasiado tiempo. Vuelve atrás, recarga la página e inténtalo de nuevo.'],
        429 => ['Demasiadas solicitudes', 'Espera un momento antes de volver a intentarlo.'],
        500 => ['No se pudo completar la operación', 'Ocurrió un error inesperado.'],
        503 => ['Servicio no disponible', 'El sitio está en mantenimiento. Vuelve a intentarlo en unos minutos.'],
    ];
    [$defaultTitle, $defaultMessage] = $defaults[$code] ?? ['No se pudo completar la operación', 'Ocurrió un error.'];
    $ownMessage = isset($exception) ? trim((string) $exception->getMessage()) : '';
@endphp
@include('errors.partials.exception', [
    'status' => $code,
    'title' => $defaultTitle,
    'action' => request()->method() . ' /' . ltrim(request()->path(), '/'),
    'messageLabel' => 'Detalle',
    'message' => $ownMessage !== '' ? $ownMessage : $defaultMessage,
    'failedRequest' => null,
    'req' => [],
])
