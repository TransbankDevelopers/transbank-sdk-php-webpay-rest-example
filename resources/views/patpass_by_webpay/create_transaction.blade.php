<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<style>
    .webpay_form input {
        font-size: 20px;

    }


</style>

</head>

<body>
    <h1>Ejemplo Patpass by Webpay</h1>

    <form class="webpay_form" action="create" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
        @csrf
        <label for="buy_order">
            Orden de compra
        </label>
        <input id="buy_order" name="buy_order" value="{{ '123456' . rand(1,1000) }}"/>

        <label for="session_id">
            Id de sesión
        </label>
        <input id="session_id" name="session_id" value="session123456" />

        <label for="amount">
            Monto
        </label>
        <input id="amount" name="amount" value="1000"/>


        <label for="return_url">
            URL de retorno
        </label>
        <input id="return_url" name="return_url" value="http://0.0.0.0:8000/patpass_by_webpay/returnUrl"/>



        <h2>Detalles</h2>

        <label>Service id</label>
        <input name="details[service_id]" value="{{ 'serviceid' . rand(1, 100) }}">

        <label>Card holder id</label>
        <input name="details[card_holder_id]" value="cardholderid123"/>

        <label>Card holder name</label>
        <input name="details[card_holder_name]" value="pepito">

        <label>Card holder last name 1</label>
        <input name="details[card_holder_last_name1]" value="Perez"/>

        <label>Card holder last name 2</label>
        <input name="details[card_holder_last_name2]" value="Gonzalez"/>

        <label>Card holder mail</label>
        <input name="details[card_holder_mail]" value="info@continuum.cl">

        <label>Cellphone number</label>
        <input name="details[cellphone_number]" value="123456789" >

        <label>Expiration date</label>
        <input name="details[expiration_date]" value={{ date('Y-m-d', strtotime('+3 years')) }}>


        <label>Commerce mail</label>
        <input name="details[commerce_mail]" value='pepito@continuum.cl'>


        <label>UF flag</label>
        <select name="details[uf_flag]">
            <option value="true">True</option>
            <option value="false" selected="true">False</option>
        </select>



        {{--
                "wpm_detail": {
                "service_id": "123345567",
                "card_holder_id": "12345",
                "card_holder_name": "Juan",
                "card_holder_last_name1": "Perez",
                "card_holder_last_name2": "Gonzalez",
                "card_holder_mail": "juan.perez@gmail.com",
                "cellphone_number": "9912345678",
                "expiration_date": "2019-03-20T20:18:20Z",
                "commerce_mail": "contacto@comercio.cl",
                "uf_flag": false
                }--}}

        <button type="submit">Aceptar</button>
    </form>

</body>

</html>
