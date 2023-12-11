@extends('layout')
@section('content')
<h1> Ejemplo Transacción Completa Diferida transacción capturada</h1>

<h3>Parámetros recibidos:</h3>
<pre>
    {{ print_r($req, true) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res, true)  }}
</pre>

<div class="flex flex-row mt-5">
    <div class="border rounded-xl m-2 p-4 w-6/12">
        <h3 class="text-lg mb-4">Revisar status de la transacción</h3>
        <form action="{{ route("completa.deferred.status") }}" method="post" class="flex flex-col">
            @csrf
            <label for="token_ws">
                Token
            </label>
            <input type="text" name="_token" value={{ $req['token_ws'] }}>
            <button type="submit" class="w-full">Revisar Status</button>
        </form>
    </div>

    <div class="border rounded-xl m-2 p-4 w-6/12">
        <h3 class="text-lg mb-4">Reembolso de la transaccion</h3>
        <form action="{{ route("completa.deferred.refund") }}" method="post" class="flex flex-col">
            @csrf
            <label for="token_ws">
                Token
            </label>
            <input type="text" name="token_ws" value={{ $req["token_ws"] }}>
            <label for="amount">
                Monto
            </label>
            <input type="number" name="amount" value={{ $res->getCapturedAmount() }}>
            <button type="submit" class="w-full"> Solicitar Reembolso</button>
        </form>
    </div>
</div>
@endsection
