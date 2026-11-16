{{--
    Formulario de creación de Webpay Plus (normal, Bines y Captura Diferida).
    Parámetros: $title, $intro, $action, $buyOrder, $sessionId, $amount, $returnUrl
--}}
<div class="w-full max-w-none">
    <h1 class="mb-2">{{ $title }}</h1>
    <p class="text-gray-700 mb-6">{{ $intro }}</p>

    <form action="{{ url($action) }}" method="post" class="tbk-form-stack-lg mall-builder">
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Datos de la transacción</h3>
            <div class="mall-builder__grid">
                <div class="mall-builder__field">
                    <label for="buy_order">Orden de compra</label>
                    <input id="buy_order" name="buy_order" type="text" maxlength="26" value="{{ $buyOrder }}" required autocomplete="off">
                </div>

                <div class="mall-builder__field">
                    <label for="session_id">Id de sesión</label>
                    <input id="session_id" name="session_id" type="text" maxlength="61" value="{{ $sessionId }}" required autocomplete="off">
                </div>

                <div class="mall-builder__field">
                    <label for="amount">Monto</label>
                    <input id="amount" name="amount" type="number" min="1" step="1" inputmode="numeric" value="{{ $amount }}" required>
                </div>

                <div class="mall-builder__field mall-builder__field--wide">
                    <label for="return_url">URL de retorno</label>
                    <input id="return_url" name="return_url" type="url" value="{{ $returnUrl }}" required>
                </div>
            </div>
        </div>

        <div class="mall-builder__footer">
            <span></span>
            <button type="submit" class="mall-builder__submit">Crear transacción</button>
        </div>
    </form>
</div>
