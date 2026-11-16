@extends('layout')
@section('content')
    @include('errors.partials.http', ['code' => 419])
@endsection
