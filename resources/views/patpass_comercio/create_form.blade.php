@extends('layout')
@section('content')
<h1>Patpass Comercio</h1>
<form class="webpay_form" action="create-form" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <label for="url">
        URL
    </label>
    <input id="url" name="url" value="{{ url('/') }}/patpass_comercio/returnUrl"/>

    <label for="nombre">
        Nombre
    </label>
    <input id="nombre" name="nombre" value="Pepito" />

    <label for="pApellido">
        Apellido Paterno
    </label>
    <input id="pApellido" name="pApellido" value="Perez"/>

    <label for="sApellido">
        Apellido Materno
    </label>
    <input id="sApellido" name="sApellido" value="Perez"/>

    <label for="rut">
        RUT
    </label>
    <input id="rut" name="rut" value="18439979-2"/>

    <label for="serviceId">
        Service Id (rut con digito verificador, sin puntos ni guión)
    </label>
    <input id="serviceId" name="serviceId" value="{{ '184399792' }}"/>

    <label for="finalUrl">
        URL Final
    </label>
    <input id="finalUrl" name="finalUrl" value="{{ url('/') }}/patpass_comercio/voucherUrl" />

    <label for="montoMaximo">
        Monto Máximo
    </label>
    <input id="montoMaximo" name="montoMaximo" value="1000" />

    <label for="telefonoFijo">
        Teléfono Fijo
    </label>
    <input id="telefonoFijo" name="telefonoFijo" value="+5622000000" />

    <label for="telefonoCelular">
        Teléfono Celular
    </label>
    <input id="telefonoCelular" name="telefonoCelular" value="+56900000000" />

    <label for="nombrePatPass">
        Nombre Patpass
    </label>
    <input id="nombrePatPass" name="nombrePatPass" value="Test patpass" />

    <label for="correoPersona">
        Correo Persona
    </label>
    <input id="correoPersona" name="correoPersona" value="pepito@continuum.cl" />

    <label for="correoComercio">
        Correo Comercio
    </label>
    <input id="correoComercio" name="correoComercio" value="comercio@continuum.cl" />

    <label for="direccion">
        Dirección
    </label>
    <input id="direccion" name="direccion" value="huerfanos 101" />

    <label for="ciudad">
        Ciudad
    </label>
    <input id="ciudad" name="ciudad" value="Santiago" />


    <button type="submit">Aceptar</button>
</form>
@endsection
