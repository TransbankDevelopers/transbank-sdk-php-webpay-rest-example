@extends('layout')
@section('content')
<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>



<h1>Confirmar transacción</h1>
<form class="transaccion_completa_form" action="/transaccion_completa/mall_commit" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <label for="token">Token</label>
    <input name="token" value="{{ $req['token_ws'] }}">

    <h3>Comercio 1</h3>
    <hr>
    <label for="etails_commerce_code_1">Codigo de comercio (comercio hijo)</label>
    <input id="details_commerce_code_1" name="details[0][commerce_code]" value="{{ $details[0]['commerce_code'] }}">

    <label for="details_buy_order_1">Orden de compra (comercio hijo)</label>
    <input id="details_buy_order_1" name="details[0][buy_order]" value="{{ $details[0]['buy_order'] }}"/>

    <label for="id_query_installments_1">Id query installments</label>
    <input id="id_query_installments_1" name="details[0][id_query_installments]" value="{{ $res[0]->getIdQueryInstallments()  }}">

    <label for="deferred_period_index_1">Deferred period index</label>
    <select name="details[0][deferred_period_index]" id="deferred_period_index_1">
        <option value="" selected></option>
        @foreach ($res[0]->getDeferredPeriods() as $per)
            <option selected value="{{ $per }}">{{ $per }}</option>
        @endforeach
    </select>

    <label for="grace_period_1">Periodo de gracia</label>
    <select name="details[0][grace_period]">
        <option value="true">true</option>
        <option selected value="false">false</option>
    </select>

    <h3>Comercio 2</h3>
    <hr>

    <label for="etails_commerce_code_2">Codigo de comercio (comercio hijo)</label>
    <input id="details_commerce_code_2" name="details[1][commerce_code]" value="{{ $details[1]['commerce_code'] }}">

    <label for="details_buy_order_2">Orden de compra (comercio hijo)</label>
    <input id="details_buy_order_2" name="details[1][buy_order]" value="{{ $details[1]['buy_order'] }}"/>


    <label for="id_query_installments">Id query installments</label>
    <input id="id_query_installments_2" name="details[1][id_query_installments]" value="{{ $res[1]->getIdQueryInstallments() }}">

    <label for="deferred_period_index_2">Deferred period index</label>
    <select name="details[1][deferred_period_index]" id="deferred_period_index_2">
        <option value="" selected></option>
        @foreach ($res[1]->getDeferredPeriods() as $per)
            <option selected value="{{ $per }}">{{ $per }}</option>
        @endforeach
    </select>

    <label for="grace_period_2">Periodo de gracia</label>
    <select id="grace_period_2" name="details[1][grace_period]">
        <option value="true">true</option>
        <option selected value="false">false</option>
    </select>

    <button type="submit">Enviar</button>

</form>
@endsection
