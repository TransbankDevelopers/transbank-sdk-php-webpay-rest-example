@extends('layout')
@section('content')
    <h1> Oneclick mall inscripción finalizada</h1>

<h2>Request</h2>
<pre> {{  print_r($req, true) }} </pre>

<h2>Respuesta</h2>
@if ($resp['response_code'] == 0)
    <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
@else
    <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
@endif
<pre> {{  print_r($resp, true) }} </pre>

@if ($resp['response_code'] == 0)

    <h1>Autorizar transacción</h1>
    <form method="post" action="/oneclick/standard_brand/mall/authorizeTransaction" style="display: flex; flex-direction:column; font-size: 20px; gap: 8px;">
        @csrf

        <label for="username" style="margin-top: 8px;">Nombre de usuario</label>
        <input id="username" name="username" value="{{ $username }}"/>

        <label for="tbk_user">Codigo de usuario</label>
        <input id="tbk_user" name="tbk_user" value="{{ $resp['tbk_user'] }}"/>

        <label for="parent_buy_order">Orden de compra (comercio padre)</label>
        <input id="parent_buy_order" name="buy_order" value="{{rand(100000000, 999999999)}}"/>

        <label for="pos_entry_mode">POS Entry Mode</label>
        <select class="border rounded p-2" id="pos_entry_mode" name="pos_entry_mode">
            <option value="01">Manual</option>
            <option value="010" selected>Archivo</option>
            <option value="810">Comercio electrónico</option>
        </select>

         <label for="request_3ds_authentication">Solicitar autenticación 3DS</label>
        <select class="border rounded p-2" id="request_3ds_authentication" name="request_3ds_authentication">
            <option value="SI" selected>Si</option>
            <option value="NO">No</option>
        </select>

        <h1 class="mt-2">Detalle de la transacción</h1>
        <label for="details_commerce_code">Código de comercio tienda</label>
        @if (app()->environment('production'))
            <?php $childCC = config('services.transbank.oneclick_mall_standard_brand_child_cc') ?>
            <select class="border rounded p-2" id="details_commerce_code" name="details[0][commerce_code]" value="{{ $childCC }}">
                <option value="{{ $childCC }}">Comercio Hijo - {{ $childCC }}</option>
            </select>
        @else
        <!-- TODO: Add testing configuration here -->
            <?php $childCC = config('services.transbank.oneclick_mall_standard_brand_child_cc') ?>
            <select class="border rounded p-2" id="details_commerce_code" name="details[0][commerce_code]" value="{{ $childCC }}">
                <option value="{{ $childCC }}">Comercio Hijo - {{ $childCC }}</option>
            </select>
        @endif


        <label for="details_buy_order">Orden de compra (comercio hijo)</label>
        <input id="details_buy_order" name="details[0][buy_order]" value="{{"child-". rand(100000000, 999999999) }}"/>

        <label for="details_amount">Monto</label>
        <input id="details_amount" name="details[0][amount]" value="1000"/>

        <label for="details_installments_number">Cantidad de cuotas</label>
        <select class="border rounded p-2" id="details_installments_number" name="details[0][installments_number]">
            <option value="1">0</option>
            <option value="2">1</option>
            <option value="3">2</option>
            <option value="4">3</option>
            <option value="5">4</option>
            <option value="6">5</option>
            <option value="7">6</option>
        </select>

        <label for="pmnt_ind">Índice de período diferido</label>
        <select class="border rounded p-2" id="pmnt_ind" name="details[0][pmnt_ind]" value="0"/>
            <option value="C" selected>Cardholder consent for Credential on File (COF)</option>
            <option value="R">Recurring Payment</option>
            <option value="">Unknown / Not Provided</option>
        </select>

        <label for="recur_pmnt">Tipo de importe</label>
        <select class="border rounded p-2" id="recur_pmnt" name="details[0][recur_pmnt]" value="0"/>
            <option value="F">Importe fijo</option>
            <option value="V">Importe variable</option>
            <option value=" " selected>No hay información disponible</option>
        </select>

        <label for="tid">Transaction ID</label>
        <input id="tid" name="details[0][tid]" value=""/>

        <h1 class="mt-4">Datos del navegador</h1>

        <label for="browserAcceptHeader">Cabecera Accept del navegador</label>
        <input id="browserAcceptHeader" name="details[0][browserAcceptHeader]" value="{{ $metaData['accept_header'] }}"/>

        <label for="browserIP">IP del navegador</label>
        <input id="browserIP" name="details[0][browserIP]" value="{{ $metaData['ip_address'] }}" placeholder="Cargando..."/>

        <label for="browserJavaEnabled">Java habilitado</label>
        <input id="browserJavaEnabled" name="details[0][browserJavaEnabled]" value=""/>

        <label for="browserLanguage">Idioma del navegador</label>
        <input id="browserLanguage" name="details[0][browserLanguage]" value="{{ $metaData['language'] }}"/>

        <label for="browserScreenHeight">Alto del navegador</label>
        <input id="browserScreenHeight" name="details[0][browserScreenHeight]" value=""/>

        <label for="browserScreenWidth">Ancho del navegador</label>
        <input id="browserScreenWidth" name="details[0][browserScreenWidth]" value=""/>

        <label for="browserTZ">Zona horaria (minutos respecto UTC)</label>
        <input id="browserTZ" name="details[0][browserTZ]" value=""/>

        <label for="browserUserAgent">User Agent del navegador</label>
        <input id="browserUserAgent" name="details[0][browserUserAgent]" value="{{ $metaData['user_agent'] }}"/>

        <label for="browserJavascriptEnabled">Javascript habilitado</label>
        <input id="browserJavascriptEnabled" name="details[0][browserJavascriptEnabled]" value="true"/>

        <button type="submit">Enviar</button>
    </form>

    <hr>

    <h1>Eliminar inscripcion</h1>
    <form method="delete" action="/oneclick/standard_brand/inscription" style="display: flex; flex-direction:column; font-size: 20px; gap: 10px;">

        <label style="margin-top: 10px;">Nombre de usuario</label>
        <input name="user_name" value="{{ $username}}"/>

        <label>Id de usuario</label>
        <input name="tbk_user" value="{{ $resp['tbk_user'] }}"/>

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
@endif
@endsection
