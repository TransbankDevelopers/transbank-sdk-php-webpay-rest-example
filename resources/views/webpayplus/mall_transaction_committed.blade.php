<h1>Transacción confirmada</h1>

<div>

    <div>
        <h2>Parametros</h2>
        {{ var_dump($params) }}
        <h2>Respuesta</h2>
        {{ var_dump($response) }}
    </div>

    <h2>Obtener status de la transacción</h2>

    <form method="post" action="/webpayplus/mallTransactionStatus">
        @csrf
        <input type="hidden"
               value="{{ $params["token_ws"] }}"
               name="token">
        <div> Token: {{ $params["token_ws"] }}</div>
        <button type="submit">Obtener status</button>
    </form>

    <h2>Reembolsar la transacción</h2>
    <h3>Transaccion 1</h3>
    <form method="post" action="/webpayplus/mallRefund" style="display: flex; flex-direction: column; width: 20%;">
{{--        $token, $buyOrder, $childCommerceCode, $amount--}}
        @csrf
        <input type="hidden" name="token" value="{{ $params["token_ws"] }}">

        <label for="buy_order_1">Buy Order</label>
        <input id="buy_order_1" name="buy_order" value="{{ $response->getDetails()[0]["buy_order"]  }}" >

        <label for="child_commerce_code_1">Commerce Code hijo</label>
        <input id="child_commerce_code_1" name="commerce_code" value="{{ $response->getDetails()[0]["commerce_code"]  }}" >

        <label for="child_amount_1">Monto 1</label>
        <input id="child_amount_1" name="amount" value="{{ $response->getDetails()[0]["amount"]  }}" >

        <button type="submit">Enviar</button>
    </form>

    <h3>Transaccion 2</h3>
    <form method="post" action="/webpayplus/mallRefund" style="display:flex; flex-direction: column; width: 20%;">
        {{--        $token, $buyOrder, $childCommerceCode, $amount--}}
        @csrf
        <input type="hidden" name="token" value="{{ $params["token_ws"] }}">

        <label for="buy_order_1">Buy Order</label>
        <input id="buy_order_1" name="buy_order" value="{{ $response->getDetails()[1]["buy_order"]  }}" >

        <label for="child_commerce_code_1">Commerce Code hijo</label>
        <input id="child_commerce_code_1" name="commerce_code" value="{{ $response->getDetails()[1]["commerce_code"]  }}" >

        <label for="child_amount_1">Monto 2</label>
        <input id="child_amount_1" name="amount" value="{{ $response->getDetails()[1]["amount"]  }}" >
        <button type="submit">Enviar</button>
    </form>

</div>
