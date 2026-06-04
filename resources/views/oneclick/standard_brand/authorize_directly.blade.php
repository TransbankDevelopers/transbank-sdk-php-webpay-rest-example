@extends('layout')
@section('content')
    <h1>Autorizar transacción directamente</h1>

    <form method="post" action="/oneclick/standard_brand/mall/authorizeTransaction" class="flex flex-col text-xl gap-2">
        @csrf

        <label for="username" class="mt-2">Nombre de usuario</label>
        <input id="username" name="username" value="" required/>

        <label for="tbk_user">Tbk User</label>
        <input id="tbk_user" name="tbk_user" value="" required/>

        <label for="parent_buy_order">Orden de compra (comercio padre)</label>
        <input id="parent_buy_order" name="buy_order" value="{{ $parentBuyOrder }}"/>

        <label for="pos_entry_mode">POS Entry Mode</label>
        <select class="border rounded p-2" id="pos_entry_mode" name="pos_entry_mode">
            <option value="010" selected>(010) - Credenciales en archivo</option>
            <option value="100">(100) - CIT siguientes / MIT siguientes recurrentes</option>
            <option value="810">(810) - Comercio electrónico</option>
        </select>

        <label for="request_3ds_authentication">Solicitar autenticación 3DS</label>
        <select class="border rounded p-2" id="request_3ds_authentication" name="request_3ds_authentication">
            <option value="SI" selected>Si</option>
            <option value="NO">No</option>
        </select>

        <h1 class="mt-2">Detalle de la transacción</h1>
        <label for="details_commerce_code">Código de comercio tienda</label>
        <select class="border rounded p-2" id="details_commerce_code" name="details[0][commerce_code]" value="{{ $childCC }}">
            <option value="{{ $childCC }}">Comercio Hijo - {{ $childCC }}</option>
        </select>

        <label for="details_buy_order">Orden de compra (comercio hijo)</label>
        <input id="details_buy_order" name="details[0][buy_order]" value="{{ $detailsBuyOrder }}"/>

        <label for="details_amount">Monto</label>
        <input id="details_amount" name="details[0][amount]" value="50"/>

        <label for="details_installments_number">Cantidad de cuotas</label>
        <input class="border rounded p-2" id="details_installments_number" type="number" name="details[0][installments_number]" value="0" min="0" max="99"/>

        <label for="pmnt_ind">Tipo de pago</label>
        <select class="border rounded p-2" id="pmnt_ind" name="details[0][pmnt_ind]" value="0"/>
            <option value="C" selected>(C) - Titular acepta almacenar credenciales (COF)</option>
            <option value="R">(R) - Pago recurrente</option>
            <option value=" ">( ) - Desconocido</option>
        </select>

        <label for="recur_pmnt">Tipo de importe</label>
        <select class="border rounded p-2" id="recur_pmnt" name="details[0][recur_pmnt]" value=" "/>
            <option value="F">(F) - Importe fijo</option>
            <option value="V">(V) - Importe variable</option>
            <option value=" " selected>( ) - No hay información disponible</option>
        </select>

        <label for="tid">Transaction ID</label>
        <input id="tid" name="details[0][tid]" value=""/>

        <h1 class="mt-4">Datos del navegador</h1>

        <label for="browserAcceptHeader">Cabecera Accept del navegador</label>
        <input id="browserAcceptHeader" name="details[0][browserAcceptHeader]"
            value="{{ $metaData['accept_header'] }}"/>
        
        <label for="browserUserAgent">User Agent del navegador</label>
        <input id="browserUserAgent" name="details[0][browserUserAgent]" value="{{ $metaData['user_agent'] }}"/>

        <label for="browserIP">IP del navegador</label>
        <input id="browserIP" name="details[0][browserIP]" value="{{ $metaData['ip_address'] }}" placeholder="Cargando..."/>

        <label for="browserJavaEnabled">Java habilitado</label>
        <input id="browserJavaEnabled" name="details[0][browserJavaEnabled]" value=""/>

        <label for="browserScreenHeight">Alto del navegador</label>
        <input id="browserScreenHeight" name="details[0][browserScreenHeight]" value=""/>

        <label for="browserScreenWidth">Ancho del navegador</label>
        <input id="browserScreenWidth" name="details[0][browserScreenWidth]" value=""/>

        <label for="browserTZ">Zona horaria (minutos respecto UTC)</label>
        <input id="browserTZ" name="details[0][browserTZ]" value=""/>

        <label for="browserJavascriptEnabled">Javascript habilitado</label>
        <input id="browserJavascriptEnabled" name="details[0][browserJavascriptEnabled]" value="true"/>

        <button type="submit">Enviar</button>
    </form>

    <script>
        async function getTransactionDetails() {
            const details = {
                browserJavaEnabled: navigator.javaEnabled ? navigator.javaEnabled() : 'false',
                browserScreenHeight: window.screen.height.toString(),
                browserScreenWidth: window.screen.width.toString(),
                browserTZ: String(new Date().getTimezoneOffset()),
                browserJavascriptEnabled: true
            };

            return details;
        }

        document.addEventListener('DOMContentLoaded', async function() {
            const details = await getTransactionDetails();

            document.getElementById('browserJavaEnabled').value = details.browserJavaEnabled;
            document.getElementById('browserScreenHeight').value = details.browserScreenHeight;
            document.getElementById('browserScreenWidth').value = details.browserScreenWidth;
            document.getElementById('browserTZ').value = details.browserTZ;
            document.getElementById('browserJavascriptEnabled').value = details.browserJavascriptEnabled;
        });
    </script>
@endsection
