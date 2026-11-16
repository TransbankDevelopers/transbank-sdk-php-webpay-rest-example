{{--
    Formulario para iniciar una inscripción Oneclick.
    Parámetros: $title, $action, $responseUrl, $directAuthorizeUrl (opcional)
--}}
<div class="w-full max-w-none">
    <h1 class="mb-2">{{ $title }}</h1>
    <p class="text-gray-700 mb-6">Inscribe la tarjeta del usuario. Webpay lo guiará para registrarla y luego volverá a la URL de respuesta.</p>

    <form action="{{ url($action) }}" method="post" class="tbk-form-stack-lg mall-builder">
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Datos del usuario</h3>
            <div class="mall-builder__grid">
                <div class="mall-builder__field">
                    <label for="userName">Nombre de usuario</label>
                    <input id="userName" name="user_name" type="text" maxlength="40" value="nombre_de_usuario" required autocomplete="off">
                </div>

                <div class="mall-builder__field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" maxlength="100" value="example@example.com" required>
                </div>

                <div class="mall-builder__field mall-builder__field--wide">
                    <label for="responseUrl">URL de respuesta</label>
                    <input id="responseUrl" name="response_url" type="url" value="{{ $responseUrl }}" required>
                </div>
            </div>
        </div>

        <div class="mall-builder__footer">
            <span></span>
            <button type="submit" class="mall-builder__submit">Iniciar inscripción</button>
        </div>
    </form>

    @if (!empty($directAuthorizeUrl))
        <div class="bg-white border border-gray-200 rounded-lg p-4 mt-6">
            <h3 class="font-bold mb-1">Autorizar con una cuenta existente</h3>
            <p class="mall-builder__hint">Si el usuario ya tiene una tarjeta inscrita, puedes autorizar el pago directamente.</p>
            <a class="tbk-btn-link mall-builder__submit" href="{{ url($directAuthorizeUrl) }}">Ir a autorizar</a>
        </div>
    @endif
</div>
