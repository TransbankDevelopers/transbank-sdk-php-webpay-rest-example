@extends('layout')
@section('content')
    @include('errors.partials.http', ['code' => 429])
@endsection
