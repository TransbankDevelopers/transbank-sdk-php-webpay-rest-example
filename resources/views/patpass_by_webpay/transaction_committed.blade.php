<h1>Transacción Patpass by Webpay confirmada</h1>

<div>

    <pre>
        {{ print_r($resp, true) }}
    </pre>


    <h2>Estado de la transacción</h2>
    <form method="get" action="/patpass_by_webpay/transactionStatus" >
        <input name="token" value="{{ $req['token_ws'] }}" />

        <button type="submit">Enviar</button>
    </form>

</div>
