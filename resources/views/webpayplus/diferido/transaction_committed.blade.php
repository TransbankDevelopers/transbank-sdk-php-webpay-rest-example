<h1>Transacción confirmada</h1>

<div>

    <div>
        {{ var_dump($resp) }}
    </div>


    <h2>Capturar monto</h2>

    <form method="post" action="/webpayplus/diferido/capture">
        @csrf
        <input type="hidden" name="token" value={{ $req["token_ws"] }}>
        <input type="hidden" name="buy_order" value={{ $resp->getBuyOrder() }} >
        <input type="hidden" name="authorization_code" value={{ $resp->getAuthorizationCode() }} >
        <input type="hidden" name="capture_amount" value={{ $resp->getAmount() }} >
        <button type="submit">Capturar</button>
    </form>

    <h2>Obtener status de la transacción</h2>

    <form method="post" action="/webpayplus/diferido/status">
        @csrf
        <input type="hidden"
               value="{{ $req["token_ws"] }}"
               name="token">
        <div> Token: {{ $req["token_ws"] }}</div>
        <button type="submit">Obtener status</button>
    </form>

</div>
