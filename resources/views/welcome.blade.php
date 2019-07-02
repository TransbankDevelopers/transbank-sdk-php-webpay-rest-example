<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">



</head>

    <body>

        <div class="main_content">
            <h1 class="header">
                Ejemplos Webpay
            </h1>

            <div class="examples_container" style="padding: 10px;">
                <span class="operation_title" style="border: 1px solid black; padding: 5px">
                    Transacción Simple
                </span>
                <span class="operation_link" style="border: 1px solid black; padding: 5px">
                    <a href="webpayplus/create">Webpay plus normal</a>
                </span>

                <span class="operation_nullify" style="border: 1px solid black; padding: 5px">
                    <a href="webpayplus/refund">Webpay plus normal anulación</a>
                </span>
            </div>

            <div class="examples_container" style="padding: 10px;">
                <span class="operation_title" style="border: 1px solid black; padding: 5px">
                    Transaction Mall
                </span>
                <span class="operation_link" style="border: 1px solid black; padding: 5px">
                    <a href="webpayplus/createMall">Webpay plus mall</a>
                </span>

                <span class="operation_link" style="border: 1px solid black; padding: 5px">
                    <a href="webpayplus/refundMall">Webpay plus mall anulación</a>
                </span>

            </div>

        </div>


    </body>

</html>
