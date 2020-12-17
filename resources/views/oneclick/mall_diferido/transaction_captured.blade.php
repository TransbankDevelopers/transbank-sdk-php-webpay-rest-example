<h1>Oneclick Mall Captura realizada</h1>

<h1>Request</h1>
<pre> {{  print_r($req, true) }} </pre>


<h1>Response</h1>
<pre> {{  print_r($resp, true) }} </pre>


<h2>Estado de la transacción</h2>
<form method="post" action="/oneclick/mall/diferido/transactionStatus" >
    @csrf
    <label>Buy order: {{ $req['buy_order'] }}</label>
    <input type="text" name="buy_order" value="{{  $req['parent_buy_order'] }}">

    <button type="submit">Enviar datos</button>
</form>

<h2>Reembolso de la transacción</h2>
<form method="post" action="/oneclick/mall/diferido/refund">
    @csrf
    <label>Buy order padre</label>
    <input name="parent_buy_order" value="{{ $req['parent_buy_order'] }}">

    <label>Commerce code hijo</label>
    <input name="commerce_code" value="{{ $req['commerce_code'] }}">

    <label>Buy order hijo</label>
    <input name="child_buy_order" value="{{ $req['buy_order'] }}">

    <label>Monto</label>
    <input name="amount" value="{{ $req['amount'] }}"/>

    <button type="submit">Enviar</button>
</form>
