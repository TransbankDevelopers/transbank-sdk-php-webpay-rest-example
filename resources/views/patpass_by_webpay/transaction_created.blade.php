<h1> Ejemplo Transacción PatPass By Webpay</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($resp)  }}
</pre>

<form method="post" action={{  $resp->getUrl() }}>
    <input name="token_ws" value={{ $resp->getToken() }} />

    <button type="submit">Enviar datos</button>
</form>



