@extends('layout')
@section('content')
    <h1>Webpay plus Mall Transacción diferida capturada</h1>

    <h2>Request</h2>
    <pre>{{ print_r($req, true) }}</pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>


    <h2>Reembolsar la transacción</h2>
    <form method="post" action="/webpayplus/mall/diferido/refund" style="display: flex; flex-direction: column; width: 20%;">
        @csrf
        <input type="text" name="token" value="{{ $req["token"] }}">

        <label for="buy_order_1">Buy Order</label>
        <input id="buy_order_1" name="child_buy_order" value="{{ $req["buy_order"]  }}" >

        <label for="child_commerce_code_1">Commerce Code hijo</label>
        <input id="child_commerce_code_1" name="child_commerce_code" value="{{ $req["commerce_code"]  }}" >

        <label for="child_amount_1">Monto 1</label>
        <input id="child_amount_1" name="amount" value="{{ $req["capture_amount"]  }}" >

        <button type="submit">Enviar</button>
    </form>

    <h2>Estado de la transacción</h2>

    <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
        @csrf
        <input name="token" type="text" value={{ $req["token"] }}>
        <button type="submit">Ver estado</button>

    </form>
@endsection
