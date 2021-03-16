@extends('layout')
@section('content')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://webpay3gint.transbank.cl/webpayserver/webpay.js"></script>

    <h2 class="text-xl font-bold">Webpay Modal</h2>
    <h4 class="font-bold mt-3">Formulario de pago</h4>
    <div id="webpay_div" style="margin: 0 auto; height:637px !important"></div>

    <h4 class="font-bold mt-3">Request</h4>
    <pre>{{ print_r($request, true) }}</pre>

    <h4 class="font-bold mt-3">Response</h4>
    <pre>{{ print_r($response, true) }}</pre>


    <h4 class="font-bold mt-3">Mostrar formulario con:</h4>
    <pre>
&lt;div id="webpay_div" style="margin: 0 auto; height:637px !important"&gt;&lt;/div&gt;
&lt;script&gt;
    Webpay.show('webpay_div', '{{$token}}',
        success_callback, error_callback);
&lt;/script&gt;
    </pre>


    <script>
        $(function () {
            Webpay.show('webpay_div', '{{$token}}', function (token) {


                // Cuando lle ga la confirmación de pago al SDK Js, llamar a un endpoint propio pare realizar el commit de la transacción.
                $.post('./commit', {token: token}, function (res) {
                    if (res.responseCode === 0) {
                        swal({
                            title: 'Su transacción ha sido confirmada exitosamente',
                            text: 'Ahora puedes mostrar el voucher con los datos que llegaron o crear una página de éxito especial: \n\n' + JSON.stringify(res, null, 2),
                            icon: 'success',
                            button: 'Continuar'
                        }).then(function () {
                            window.location = './status/' + token;
                            return;
                        });
                    } else {
                        swal('Pago rechazado', 'La transacción ha sido rechazada', 'error');
                    }

                });
            }, function (token, errorCode, description) {
                swal('La transacción ha sido rechazada: ' + description, '', 'error');
            });
        });

    </script>
@endsection
