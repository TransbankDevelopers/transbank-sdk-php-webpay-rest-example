<h1>Transacción confirmada</h1>

<div>

    <div>
        <pre> {{  print_r($resp, true) }} </pre>
    </div>


    <h2>Capturar monto</h2>

    <form method="post" action="/webpayplus/diferido/capture">
        @csrf
        <input type="text" name="token" value={{ $req["token_ws"] }}>
        <input type="text" name="buy_order" value={{ $resp->getBuyOrder() }} >
        <input type="text" name="authorization_code" value={{ $resp->getAuthorizationCode() }} >
        <input type="text" name="capture_amount" value={{ $resp->getAmount() }} >
        <button type="submit">Capturar</button>
    </form>

    <h2>Obtener status de la transacción</h2>

    <form method="post" action="/webpayplus/diferido/status">
        @csrf
        <input type="text"
               value="{{ $req["token_ws"] }}"
               name="token">
        <div> Token: {{ $req["token_ws"] }}</div>
        <button type="submit">Obtener status</button>
    </form>

</div>
