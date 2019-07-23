<h1>Transacción Webpay Plus confirmada</h1>

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
    <form method="post" action="/webpayplus/refund" style="display:flex; flex-direction: column; width: 30%">
        @csrf
        <input type="hidden"
               value="{{ $req["token_ws"] }}"
               name="token">
        <div> Token: {{ $req["token_ws"] }}</div>

        <label>Monto</label>
        <input value="{{ $resp->getAmount() }}" name="amount" />
        <button type="submit">Reembolsar</button>

    </form>

</div>
