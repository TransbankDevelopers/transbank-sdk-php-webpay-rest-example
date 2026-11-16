@extends('layout')
@section('content')
    @php
        // [name, etiqueta, valor por defecto, tipo, ancho completo]
        $groups = [
            'Titular' => [
                ['nombre', 'Nombre', 'Pepito', 'text', false],
                ['pApellido', 'Apellido paterno', 'Perez', 'text', false],
                ['sApellido', 'Apellido materno', 'Perez', 'text', false],
                ['rut', 'RUT', '18439979-2', 'text', false],
            ],
            'Contacto' => [
                ['correoPersona', 'Correo del titular', 'pepito@continuum.cl', 'email', false],
                ['telefonoCelular', 'Teléfono celular', '+56900000000', 'tel', false],
                ['telefonoFijo', 'Teléfono fijo', '+5622000000', 'tel', false],
                ['direccion', 'Dirección', 'huerfanos 101', 'text', false],
                ['ciudad', 'Ciudad', 'Santiago', 'text', false],
            ],
            'Suscripción PAT' => [
                ['nombrePatPass', 'Nombre Patpass', 'Test patpass', 'text', false],
                ['serviceId', 'Service Id (RUT con dígito verificador, sin puntos ni guión)', '184399792', 'text', false],
                ['montoMaximo', 'Monto máximo', '1000', 'number', false],
                ['correoComercio', 'Correo del comercio', 'comercio@continuum.cl', 'email', false],
            ],
            'URLs' => [
                ['url', 'URL de retorno', url('/') . '/patpass_comercio/returnUrl', 'url', true],
                ['finalUrl', 'URL final', url('/') . '/patpass_comercio/voucherUrl', 'url', true],
            ],
        ];
    @endphp
    <div class="w-full max-w-none">
        <h1 class="mb-2">Patpass Comercio</h1>
        <p class="text-gray-700 mb-6">Inscribe una tarjeta para cargos recurrentes. Los datos del titular y del PAT se envían a Patpass, que guía al usuario por la inscripción.</p>

        <form action="{{ url('/patpass_comercio/create-form') }}" method="post" class="tbk-form-stack-lg mall-builder">
            @csrf

            @foreach ($groups as $group => $fields)
                <div class="bg-white border border-gray-200 rounded-lg p-4">
                    <h3 class="font-bold mb-3">{{ $group }}</h3>
                    <div class="mall-builder__grid">
                        @foreach ($fields as [$name, $label, $value, $type, $wide])
                            <div class="mall-builder__field {{ $wide ? 'mall-builder__field--wide' : '' }}">
                                <label for="{{ $name }}">{{ $label }}</label>
                                <input
                                    id="{{ $name }}"
                                    name="{{ $name }}"
                                    type="{{ $type }}"
                                    value="{{ $value }}"
                                    @if ($type === 'number') min="1" step="1" inputmode="numeric" @endif
                                    required
                                    autocomplete="off"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="mall-builder__footer">
                <span></span>
                <button type="submit" class="mall-builder__submit">Iniciar inscripción</button>
            </div>
        </form>
    </div>
@endsection
