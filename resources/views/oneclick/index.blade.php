@extends('layout')
@section('content')
    @include('oneclick.partials.operations_index', $config ?? \App\Support\OneclickIndexViewConfig::mall())
@endsection
