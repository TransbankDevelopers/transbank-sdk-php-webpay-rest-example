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
    <h1>Patpass Comercio</h1>
    <form class="webpay_form" action="create" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
        @csrf
        <label for="url">
            URL
        </label>
        <input id="url" name="url" value="http://{{$_SERVER['SERVER_ADDR']}}/{{$_SERVER['SERVER_PORT']}}/patpassComercio/returnUrl"/>

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
        <input id="rut" name="rut" value="11111111-1"/>

        <label for="serviceId">
            Service Id
        </label>
        <input id="serviceId" name="serviceId" value="{{ '123456' . rand(1,1000)}}"/>

        <label for="finalUrl">
          URL Final
        </label>
        <input id="finalUrl" name="finalUrl" value="http://{{$_SERVER['SERVER_ADDR']}}/{{$_SERVER['SERVER_PORT']}}/patpassComercio/finalUrl" />

        <label for="commerceCode">
          Commerce Code
        </label>
        <input id="commerceCode" name="commerceCode" value="28299257"/>

        <label for="montoMaximo">
          Monto Maximo
        </label>
        <input id="montoMaximo" name="montoMaximo" value="10000" />

        <label for="telefonoFijo">
          Telefono Fijo
        </label>
        <input id="telefonoFijo" name="telefonoFijo" value="+5622000000" />

        <label for="telefonoCelular">
          Telefono Celular
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
          Direccion
        </label>
        <input id="direccion" name="direccion" value="huerfanos 101" />

        <label for="ciudad">
          Ciudad
        </label>
        <input id="direccion" name="direccion" value="Santiago" />


        <button type="submit">Aceptar</button>
    </form>
</body>
