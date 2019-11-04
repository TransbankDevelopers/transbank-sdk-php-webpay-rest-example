<h1>Webpay Transacción diferida capturada</h1>

<h2>Request</h2>
<pre> {{  var_dump($req) }} </pre>

<h2> Response </h2>
<pre> {{  var_dump($resp) }} </pre>





<h2>Reembolso</h2>
<form method="post" action="/webpayplus/diferido/refund">
    @csrf
    <input name="token" type="hidden" value={{ $req["token"] }}>
    <input name="amount" type="hidden" value={{ $resp->getCapturedAmount() }}>

    <button type="submit">Reembolsar transacción </button>

</form>

<h2>Estado de la transacción</h2>

<form method="post" action="/webpayplus/diferido/status">
    @csrf
    <input name="amount" type="hidden" value={{ $resp->getCapturedAmount() }}>
    <input name="token" type="hidden" value={{ $req["token"] }}>
    <button type="submit">Ver estado</button>

</form>
