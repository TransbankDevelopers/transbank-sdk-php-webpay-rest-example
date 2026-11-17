@extends('layout')
@section('pageClass', 'result-page')
@section('content')
    <pre>{{ print_r($resp, true) }}</pre>
@endsection

