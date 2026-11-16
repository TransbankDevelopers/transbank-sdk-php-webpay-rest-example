@extends('layout')
@section('content')
    @include('errors.partials.exception', \App\Support\ExceptionViewData::from($exception ?? null, [
        'title' => 'Error en Transacción Completa Estándar Marca',
        'action' => $action ?? null,
        'status' => $status ?? 500,
        'message' => $message ?? null,
        'req' => $req ?? [],
    ]))
@endsection
