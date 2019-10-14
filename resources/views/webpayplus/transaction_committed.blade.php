<h1>Transacción confirmada</h1>

<div>

    <div>
        {{ var_dump($resp) }}
    </div>

    <h2>Obtener status de la transacción</h2>

    <form method="post" action="/webpayplus/transactionStatus">
        @csrf
        <input type="hidden"
               value="{{ $req["token_ws"] }}"
               name="token">
        <div> Token: {{ $req["token_ws"] }}</div>
        <button type="submit">Obtener status</button>
    </form>

    <h2>Reembolso de la transacción</h2>
    <form method="post" action="/webpayplus/refund">
        @csrf
        <input type="hidden"
               value="{{ $req["token_ws"] }}"
               name="token">
        <input type="hidden"
                value="{{ $resp->getAmount() }}"
                name="amount">
        <div> Token: {{ $req["token_ws"] }}</div>
        <div> Monto: {{ $resp->getAmount() }}</div>
        <button type="submit">Obtener reembolso</button>
    </form>

</div>

