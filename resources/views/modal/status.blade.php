@extends('layout')
@section('content')

    <h2 class="text-xl font-bold">Webpay Modal | Estado de la transacción</h2>

    <div>
        <h4 class="font-bold mt-3">Request</h4>
        <pre>Transaction::status('{{ $token  }}')</pre>

        <h4 class="font-bold mt-3">Estado de la transacción</h4>
        <pre>{{ print_r($transaction, true) }}</pre>

        <hr>
        <h4 class="font-bold mt-3">Realizar devolución (refund)</h4>
        <form method="post" action="../refund">
            <div>
                <label for="refund_token">Token de la transacción</label>
                <input type="text" id="refund_token" name="refund_token" value="{{ $token }}">
            </div>
            <div>
                <label for="refund_amount">Monto a devolver</label>
                <input id="refund_amount" name="refund_amount" type="number" value="{{ $transaction->amount }}" placeholder="Ingrese el monto a devolver">
            </div>
            <button type="submit">Hacer refund</button>
        </form>
    </div>

@endsection
