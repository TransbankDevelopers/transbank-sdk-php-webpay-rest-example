@extends('layout')
@section('content')
    @include('transaccion_completa.partials.standard_brand_index', [
        'title' => 'Transacción Completa Mall Estándar Marca sin CVV',
        'intro' => 'Inicia un pago sin CVV o administra una transacción existente.',
        'basePath' => '/transaccion_completa/standard_brand_without_cvv',
        'childCommerceCodes' => $childCommerceCodes,
    ])
@endsection
