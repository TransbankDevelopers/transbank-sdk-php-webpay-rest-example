@extends('layout')
@section('content')
    @include('transaccion_completa.partials.standard_brand_index', [
        'title' => 'Transacción Completa Mall Estándar Marca',
        'intro' => 'Inicia un pago con CVV o administra una transacción existente.',
        'basePath' => '/transaccion_completa/standard_brand',
        'childCommerceCodes' => $childCommerceCodes,
    ])
@endsection
