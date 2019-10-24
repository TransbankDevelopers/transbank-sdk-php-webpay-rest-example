<h1>Webpay plus mall diferido transaccion confirmada</h1>

<div>

    <div>
        <h2>Parametros</h2>
        {{ var_dump($req) }}
        <h2>Respuesta</h2>
        {{ var_dump($resp) }}
    </div>

    <h2>Obtener status de la transacción</h2>

    <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
        @csrf
        <input type="hidden"
               value="{{ $req["token_ws"] }}"
               name="token">
        <div> Token: {{ $req["token_ws"] }}</div>
        <button type="submit">Obtener status</button>
    </form>



    <h2>Capturar monto</h2>

    <h3>Comercio 1</h3>
    <form method="post" action="/webpayplus/mall/diferido/capture">
        @csrf

        <label>Token</label>
        <input value="{{ $req["token_ws"] }}" name="token">

        <label for="child_commerce_code_1">Commerce Code hijo</label>
        <input id="child_commerce_code_1" name="commerce_code" value="{{ $resp->getDetails()[0]["commerce_code"]  }}" >

        <label for="buy_order_1">Buy Order</label>
        <input id="buy_order_1" name="buy_order" value="{{ $resp->getDetails()[0]["buy_order"]  }}" >

        <label for="authorization_code_1">Authorization code</label>
        <input id="authorization_code_1" name="authorization_code" value="{{ $resp->getDetails()[0]["authorization_code"]  }}" >

        <label for="child_amount_1">Monto 1</label>
        <input id="child_amount_1" name="capture_amount" value="{{ $resp->getDetails()[0]["amount"]  }}" >

            <button type="submit">Enviar</button>
    </form>

    <h3>Comercio 2</h3>
    <form method="post" action="/webpayplus/mall/diferido/capture">
        @csrf

        <label>Token</label>
        <input value="{{ $req["token_ws"] }}" name="token">

        <label for="child_commerce_code_2">Commerce Code hijo</label>
        <input id="child_commerce_code_2" name="commerce_code" value="{{ $resp->getDetails()[1]["commerce_code"]  }}" >

        <label for="buy_order_2">Buy Order</label>
        <input id="buy_order_2" name="buy_order" value="{{ $resp->getDetails()[1]["buy_order"]  }}" >

        <label for="authorization_code_2">Authorization code</label>
        <input id="authorization_code_2" name="authorization_code" value="{{ $resp->getDetails()[1]["authorization_code"]  }}" >

        <label for="child_amount_2">Monto 1</label>
        <input id="child_amount_2" name="capture_amount" value="{{ $resp->getDetails()[1]["amount"]  }}" >

        <button type="submit">Enviar</button>
    </form>

    <h2>Reembolsar la transacción</h2>
    <h3>Transaccion 1</h3>
    <form method="post" action="/webpayplus/mall/diferido/refund" style="display: flex; flex-direction: column; width: 20%;">
        @csrf
        <input type="hidden" name="token" value="{{ $req["token_ws"] }}">

        <label for="buy_order_1">Buy Order</label>
        <input id="buy_order_1" name="child_buy_order" value="{{ $resp->getDetails()[0]["buy_order"]  }}" >

        <label for="child_commerce_code_1">Commerce Code hijo</label>
        <input id="child_commerce_code_1" name="child_commerce_code" value="{{ $resp->getDetails()[0]["commerce_code"]  }}" >

        <label for="child_amount_1">Monto 1</label>
        <input id="child_amount_1" name="amount" value="{{ $resp->getDetails()[0]["amount"]  }}" >

        <button type="submit">Enviar</button>
    </form>

    <h3>Transaccion 2</h3>
    <form method="post" action="/webpayplus/mall/diferido/refund" style="display:flex; flex-direction: column; width: 20%;">
        @csrf
        <input type="hidden" name="token" value="{{ $req["token_ws"] }}">

        <label for="buy_order_1">Buy Order</label>
        <input id="buy_order_1" name="child_buy_order" value="{{ $resp->getDetails()[1]["buy_order"]  }}" >

        <label for="child_commerce_code_1">Commerce Code hijo</label>
        <input id="child_commerce_code_1" name="child_commerce_code" value="{{ $resp->getDetails()[1]["commerce_code"]  }}" >

        <label for="child_amount_1">Monto 2</label>
        <input id="child_amount_1" name="amount" value="{{ $resp->getDetails()[1]["amount"]  }}" >
        <button type="submit">Enviar</button>
    </form>

</div>
