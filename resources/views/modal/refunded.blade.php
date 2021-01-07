@extends('layout')
@section('content')

    <h2 class="text-xl font-bold">Webpay Modal | Devolución</h2>

    <div>
        @if ($error)
            <h4 class="font-bold mt-3 text-red-700">Error</h4>
            <pre class="text-red-700">{{ $error }}</pre>
        @endif
        <h4 class="font-bold mt-3">Request</h4>
        <pre>Transaction::refund('{{ $request['token']  }}', {{$request['amount']}})</pre>

        <h4 class="font-bold mt-3">Response</h4>
        <pre>@php(var_dump($response))</pre>

        <hr>
        <a class="mt-10 block" href="./status/{{ $request['token'] }}">&lt;&lt; Volver al estado de la transacción</a>
    </div>

@endsection
