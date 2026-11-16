@extends('layout')
@section('content')
    @include('errors.partials.http', ['code' => 403])
@endsection
