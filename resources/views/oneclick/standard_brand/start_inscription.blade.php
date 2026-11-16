@extends('layout')
@section('content')
    @include('oneclick.partials.start_inscription', [
        'title' => 'Oneclick Mall Estándar Marca: inscripción',
        'action' => '/oneclick/standard_brand/startInscription',
        'responseUrl' => url('/') . '/oneclick/standard_brand/responseUrl',
        'directAuthorizeUrl' => '/oneclick/standard_brand/mall/direct-authorize',
    ])
@endsection
