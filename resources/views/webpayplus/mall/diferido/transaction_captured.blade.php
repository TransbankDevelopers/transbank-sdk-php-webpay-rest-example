<h1>Webpay plus Mall Transacción diferida capturada</h1>

<h2>Request</h2>
{{ var_dump($req) }}

<h2> Response </h2>
{{ var_dump($resp) }}




<h2>Reembolsar la transacción</h2>
<h3>Transaccion 1</h3>
<form method="post" action="/webpayplus/mall/diferido/refund" style="display: flex; flex-direction: column; width: 20%;">
    @csrf
    <input type="hidden" name="token" value="{{ $req["token"] }}">

    <label for="buy_order_1">Buy Order</label>
    <input id="buy_order_1" name="buy_order" value="{{ $resp->getDetails()[0]["buy_order"]  }}" >

    <label for="child_commerce_code_1">Commerce Code hijo</label>
    <input id="child_commerce_code_1" name="commerce_code" value="{{ $resp->getDetails()[0]["commerce_code"]  }}" >

    <label for="child_amount_1">Monto 1</label>
    <input id="child_amount_1" name="amount" value="{{ $resp->getDetails()[0]["amount"]  }}" >

    <button type="submit">Enviar</button>
</form>

<h3>Transaccion 2</h3>
<form method="post" action="/webpayplus/mall/diferido/refund" style="display:flex; flex-direction: column; width: 20%;">
    {{--        $token, $buyOrder, $childCommerceCode, $amount--}}
    @csrf
    <input type="hidden" name="token" value="{{ $req["token"] }}">

    <label for="buy_order_1">Buy Order</label>
    <input id="buy_order_1" name="buy_order" value="{{ $resp->getDetails()[1]["buy_order"]  }}" >

    <label for="child_commerce_code_1">Commerce Code hijo</label>
    <input id="child_commerce_code_1" name="commerce_code" value="{{ $resp->getDetails()[1]["commerce_code"]  }}" >

    <label for="child_amount_1">Monto 2</label>
    <input id="child_amount_1" name="amount" value="{{ $resp->getDetails()[1]["amount"]  }}" >
    <button type="submit">Enviar</button>
</form>








<h2>Reembolso</h2>
<form method="post" action="/webpayplus/mall/diferido/refund">
    @csrf
    <input name="token" type="hidden" value={{ $req["token"] }}>
    <input name="amount" type="hidden" value={{ $resp->getCapturedAmount() }}>

    <button type="submit">Reembolsar transacción </button>

</form>

<h2>Estado de la transacción</h2>

<form method="post" action="/webpayplus/diferido/transactionStatus">
    @csrf
    <input name="amount" type="hidden" value={{ $resp->getCapturedAmount() }}>
    <input name="token" type="hidden" value={{ $req["token"] }}>
    <button type="submit">Ver estado</button>

</form>
