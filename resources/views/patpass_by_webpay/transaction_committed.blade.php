<h1>Transacción Patpass by Webpay confirmada</h1>

<div>

    <div>
        {{ var_dump($resp) }}
    </div>


    <h2>Estado de la transacción</h2>
    <form method="get" action="/patpass_by_webpay/transactionStatus" >
        <input name="token" value="{{ $req['token_ws'] }}" />

        <button type="submit">Enviar</button>
    </form>

</div>
