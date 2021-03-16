@extends('layout')
@section('content')
<h1>Ejemplo Transaccion Completa Cuotas consultadas</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>

<form class="webpay_form" action="/transaccion_completa/transaction_commit" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;" >
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value="{{ $req["token_ws"] }}">
    <label for="id_query_installments">
        Id de cuotas
    </label>

    <input type="text" name="id_query_installments" value="{{ $res->getIdQueryInstallments() }}" />
    <label for="deferred_period_index">
        Cantidad de periodo diferido
    </label>
    <input type="number" name="deferred_period_index" value="1" />
    <label for="grace_period">
        Periodo de Gracia
    </label>
    <input type="text" name="grace_period" value="false">
    <button type="submit">Enviar datos</button>
</form>

@endsection
