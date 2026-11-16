@extends('layout')
@section('content')
    @include('errors.partials.http', ['code' => 405])
@endsection
