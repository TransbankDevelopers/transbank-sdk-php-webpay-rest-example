@extends('layout')
@section('content')
    <h1>Webpay Plus Mall Transacción confirmada</h1>

    <div>

        <div>
            <h2 class="text-lg">Parámetros</h2>
            <pre>{{  print_r($params, true) }}</pre>

            <h2 class="text-lg">Respuesta</h2>
            @if ($response->isApproved())
                <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
            @else
                <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
            @endif
            <pre>{{  print_r($response, true) }}</pre>
        </div>

        <h2 class="text-lg mt-2 font-bold">Obtener status de la transacción</h2>

        <form method="post" action="/webpayplus/mallTransactionStatus">
            @csrf
            <input type="text"
                   value="{{ $params["token_ws"] }}"
                   name="token">
            <div> Token: {{ $params["token_ws"] }}</div>
            <button type="submit">Obtener status</button>
        </form>

        <h2 class="text-xl font-bold mt-5">Reembolsar una transacción</h2>
        @foreach($response->getDetails() as $key => $detail)
        <h3 class="text-lg mt-1">Transacción #{{ $key + 1 }}</h3>
        <form method="post" action="/webpayplus/mallRefund" style="display: flex; flex-direction: column; width: 20%;">
            @csrf
            <input type="text" name="token" value="{{ $params["token_ws"] }}">

            <label for="buy_order_1">Buy Order</label>
            <input id="buy_order_1" name="buy_order" value="{{ $detail->getBuyOrder()  }}" >

            <label for="child_commerce_code_1">Commerce Code hijo</label>
            <input id="child_commerce_code_1" name="commerce_code" value="{{ $detail->getCommerceCode()  }}" >

            <label for="child_amount_1">Monto 1</label>
            <input id="child_amount_1" name="amount" value="{{ $detail->getAmount()  }}" >

            <button type="submit">Enviar</button>
        </form>
        @endforeach



    </div>
@endsection
