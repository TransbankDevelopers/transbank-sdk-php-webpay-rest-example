@extends('layout')
@section('content')
    <h1>Transacción Webpay Plus abortada desde el formulario Webpay</h1>

    <div>


        <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción abortada</span>

        <div class="response">
            <pre>{{  print_r($resp, true) }}</pre>
        </div>

        <hr class="my-5">
        <h2 class="text-lg font-bold">Obtener status de la transacción</h2>

        <form method="post" action="/webpayplusduesqr/mallTransactionStatus">
            @csrf
            Token: <input type="text" value="{{ $resp["TBK_TOKEN"] }}" name="token">
            <button type="submit">Obtener status</button>
        </form>

    </div>
@endsection
