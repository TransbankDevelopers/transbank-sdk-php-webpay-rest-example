<h1>Ejemplo Transaccion Completa Mall transacción confirmada</h1>

<h2>Request</h2>
<pre>@php print_r($req) @endphp</pre>

<h2>Response</h2>
<pre>@php print_r($res) @endphp</pre>

<h1>Obtener status de la transacción</h1>
<form class="transaccion_completa_form" action="/transaccion_completa/mall_status/{{ $req['token'] }}" method="get" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">

  <button type="submit">Consultar estado</button>
</form>

<h1>Reembolso de la transacción</h1>
<h2>Transacción 1</h2>
<form class="transaccion_completa_form" action="/transaccion_completa/mall_refund" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <label for="token">Token</label>
    <input name="token" id="token" value="{{ $req['token'] }}">

    <label for="child_commerce_code">Código de comercio (hijo)</label>
    <input name="child_commerce_code" value="{{ $res->getDetails()[0]['commerce_code'] }}">

    <label for="child_buy_order">Codigo de comercio (hijo)</label>
    <input name="child_buy_order" value="{{ $res->getDetails()[0]['buy_order'] }}">

    <label for="amount">Monto</label>
    <input name="amount" id="amount" value="{{ $res->getDetails()[0]['amount'] }}">


    <button type="submit">Solicitar reembolso</button>
</form>

<h2>Transacción 2</h2>
<form class="transaccion_completa_form" action="/transaccion_completa/mall_refund" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <label for="token">Token</label>
    <input name="token" id="token" value="{{ $req['token'] }}">

    <label for="child_commerce_code">Codigo de comercio (hijo)</label>
    <input name="child_commerce_code" value="{{ $res->getDetails()[1]['commerce_code'] }}">

    <label for="child_buy_order">Codigo de comercio (hijo)</label>
    <input name="child_buy_order" value="{{ $res->getDetails()[1]['buy_order'] }}">

    <label for="amount">Monto</label>
    <input name="amount" id="amount" value="{{ $res->getDetails()[1]['amount'] }}">


    <button type="submit">Solicitar reembolso</button>
</form>
