@extends('layout')
@section('content')
<h1> Transacción creada. </h1>
<p class="-mt-4 mb-4">Ahora, con los datos recibidos se debe redirigir al usuario a webpay a la url indicada y con el token recibidos</p>

<div class="request">
    <h3 class="font-bold">Request:</h3>
    <pre>{{ print_r($params, true) }}</pre>
</div>

<div class="response">
    <h3 class="font-bold">Respuesta:</h3>
    <pre>{{ print_r($response, true)  }}</pre>
</div>

<form method="get" action={{  $response->getUrl() }}>
    <input name="token_ws" value={{ $response->getToken() }} />

    <button type="submit">Enviar datos</button>
</form>

<div class="example mt-10">
    <p>Con el siguiente código se realiza la redirección : </p>
    <code class="block"><pre>
&lt;form method="post" action={{  $response->getUrl() }}&gt;
    &lt;input type="text" name="token_ws" value={{ $response->getToken() }} /&gt;

    &lt;button type="submit"&gt;Enviar datos&lt;/button&gt;
&lt;/form>
    </pre></code>

</div>


@endsection
