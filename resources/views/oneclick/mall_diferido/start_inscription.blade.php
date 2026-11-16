@extends('layout')
@section('content')
    @include('oneclick.partials.start_inscription', [
        'title' => 'Oneclick Mall Diferido: inscripción',
        'action' => '/oneclick/diferido/startInscription',
        'responseUrl' => url('/') . '/oneclick/diferido/responseUrl',
    ])
@endsection
