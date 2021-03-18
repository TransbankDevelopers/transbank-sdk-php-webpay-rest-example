@extends('layout')
@section('content')
    <h1> Oneclick mall inscripción finalizada</h1>

<h2>Request</h2>
<pre>{{ print_r($req, true) }}</pre>

<h2>Respuesta</h2>
<pre>{{ print_r($resp, true) }}</pre>

<h2>Autorizar transacción</h2>
<form method="post" action="/oneclick/mall/diferido/authorizeTransaction" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf

    <label for="username">Nombre de usuario</label>
    <input id="username" name="username" value="{{ isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : ''}}"/>

    <label for="tbk_user">Codigo de usuario</label>
    <input id="tbk_user" name="tbk_user" value="{{ $resp->getTbkUser() }}"/>

    <label for="parent_buy_order">Orden de compra (comercio padre)</label>
    <input id="parent_buy_order" name="buy_order" value="{{"123456".rand(1, 100)}}"/>

    <label for="details_commerce_code">Detalles de transacción</label>
    @if (app()->environment('production'))
        <?php $childCC = config('services.transbank.oneclick_mall_deferred_child_cc') ?>
        <select id="details_commerce_code" name="details[0][commerce_code]" value="{{ $childCC }}">
            <option value="{{ $childCC }}">Comercio Hijo - {{ $childCC }}</option>
        </select>
    @else
        <select id="details_commerce_code" name="details[0][commerce_code]" value="597055555549">
            <option value="597055555548"> Comercio 1 - Codigo 597055555548</option>
            <option value="597055555549">Comercio 2 - Codigo 597055555549</option>
        </select>
    @endif

    <label for="details_buy_order">Orden de compra (comercio hijo)</label>
    <input id="details_buy_order" name="details[0][buy_order]" value="{{"abcdef".rand(1, 100)}}"/>

    <label for="details_amount">Monto</label>
    <input id="details_amount" name="details[0][amount]" value="1000"/>

    <label for="details_installments_number">Cantidad de cuotas</label>
    <select id="details_installments_number" name="details[0][installments_number]" value="3">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select>

    <button type="submit">Enviar</button>
</form>

<h2>Eliminar inscripcion</h2>
<form method="delete" action="/oneclick/diferido/inscription" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">

    <label>Nombre de usuario</label>
    <input name="user_name" value="{{ isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : ''}}"/>

    <label>Id de usuario</label>
    <input name="tbk_user" value="{{ $resp->getTbkUser() }}"/>

    <button type="submit">Enviar</button>


</form>
@endsection
