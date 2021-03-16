@extends('layout')
@section('content')
    <h1>Transacción Webpay Plus confirmada</h1>

    <div>

        @if ($resp->isApproved())
            <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
        @else
            <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
        @endif
        <div class="response">
            <pre>{{  print_r($resp, true) }}</pre>
        </div>

        <hr class="my-5">
        <h2 class="text-lg font-bold">Obtener status de la transacción</h2>

        <form method="post" action="/webpayplus/transactionStatus">
            @csrf
            Token: <input type="text" value="{{ $req["token_ws"] }}" name="token">
            <button type="submit">Obtener status</button>
        </form>

        <h2 class="text-lg font-bold mt-10">Reembolso de la transacción</h2>
        <form method="post" action="/webpayplus/refund">
            @csrf
            Token: <input type="text" value="{{ $req["token_ws"] }}" name="token"><br>
            Monto: <input type="text" value="{{ $resp->getAmount() }}" name="amount">
            <button type="submit">Obtener reembolso</button>
        </form>

    </div>
@endsection
