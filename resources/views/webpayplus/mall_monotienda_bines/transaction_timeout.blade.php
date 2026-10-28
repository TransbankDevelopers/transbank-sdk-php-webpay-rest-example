@extends('layout')
@section('content')
    <h1>Webpay Mall Monotienda - Bines: sesión expirada</h1>

    <div class="response">
        <pre>{{ print_r($resp, true) }}</pre>
    </div>
@endsection
