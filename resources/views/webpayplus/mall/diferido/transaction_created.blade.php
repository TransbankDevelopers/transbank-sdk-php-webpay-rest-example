@extends('layout')
@section('pageClass', 'result-page')
@section('content')
    <h1> Ejemplo Transacción Webpay Plus Mall Diferido</h1>

    <h3>Parametros recibidos:</h3>
    <pre>
        {{ print_r($params, true) }}
    </pre>


    <h3>Respuesta:</h3>
    <pre>
        {{ print_r($response, true)  }}
    </pre>

    <form method="post" action={{  $response->getUrl() }}>
        <input name="token_ws" value={{ $response->getToken() }} />

        <button type="submit">Enviar datos</button>
    </form>

@endsection

