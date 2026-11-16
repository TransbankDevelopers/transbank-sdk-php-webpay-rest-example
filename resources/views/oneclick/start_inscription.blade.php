@extends('layout')
@section('content')
    @include('oneclick.partials.start_inscription', [
        'title' => 'Oneclick Mall: inscripción',
        'action' => '/oneclick/startInscription',
        'responseUrl' => url('/') . '/oneclick/responseUrl',
    ])
@endsection
