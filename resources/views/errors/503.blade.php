@extends('layout')
@section('content')
    @include('errors.partials.http', ['code' => 503])
@endsection
