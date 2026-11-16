@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Webpay Plus Mall - Prueba Cuotas QR</h1>
    <p class="text-gray-700 mb-6">
        Crea una transacción mall para probar el pago en cuotas con QR. Elige qué comercios hijos participan y el monto de cada uno.
    </p>

    <form action="{{ url('/webpayplusduesqr/createMall') }}" method="post" class="tbk-form-stack-lg mall-builder" data-mall-builder>
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Comercio padre</h3>
            <div class="mall-builder__grid">
                <div class="mall-builder__field">
                    <label for="parent_merchant_buy_order">Orden de compra</label>
                    <input id="parent_merchant_buy_order" name="buy_order" type="text" maxlength="26" value="buyorder_{{ Str::random(10) }}" required autocomplete="off">
                </div>

                <div class="mall-builder__field">
                    <label for="session_id_parent">Id de sesión</label>
                    <input id="session_id_parent" name="session_id" type="text" maxlength="61" value="{{ Str::random(20) }}" required autocomplete="off">
                </div>

                <div class="mall-builder__field mall-builder__field--wide">
                    <label for="return_url">URL de retorno</label>
                    <input id="return_url" name="return_url" type="url" value="{{ route('webpayplusduesqr.commit') }}" required>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-1">Comercios hijos</h3>
            <p class="mall-builder__hint">Solo se envían los comercios marcados. Cada uno necesita su propia orden de compra.</p>

            @forelse ($childCommerceCodes as $i => $code)
                <fieldset class="mall-child" data-mall-child>
                    <legend class="mall-child__legend">
                        <label class="mall-child__toggle">
                            <input type="checkbox" name="detail[{{ $i }}][active]" value="1" checked data-mall-child-active>
                            <span>Comercio {{ $i + 1 }}</span>
                            <span class="mall-child__code">{{ $code }}</span>
                        </label>
                    </legend>

                    <div class="mall-builder__grid mall-builder__grid--three">
                        <div class="mall-builder__field">
                            <label for="merchant_{{ $i }}_commerce_code">Código de comercio</label>
                            <input id="merchant_{{ $i }}_commerce_code" name="detail[{{ $i }}][commerce_code]" type="text" maxlength="12" value="{{ $code }}" required autocomplete="off">
                        </div>

                        <div class="mall-builder__field">
                            <label for="merchant_{{ $i }}_buy_order">Orden de compra</label>
                            <input id="merchant_{{ $i }}_buy_order" name="detail[{{ $i }}][buy_order]" type="text" maxlength="26" value="buyorder_{{ Str::random(10) }}" required autocomplete="off">
                        </div>

                        <div class="mall-builder__field">
                            <label for="merchant_{{ $i }}_amount">Monto</label>
                            <input id="merchant_{{ $i }}_amount" name="detail[{{ $i }}][amount]" type="number" min="1" step="1" inputmode="numeric" value="1000" required data-mall-child-amount>
                        </div>
                    </div>
                </fieldset>
            @empty
                <p class="mall-builder__empty">
                    No hay comercios hijos configurados. Define <code>WEBPAY_PLUS_MALL_DUES_QR_CHILD_CC</code> (separados por coma) para usar este ejemplo.
                </p>
            @endforelse
        </div>

        <div class="mall-builder__footer">
            <p class="mall-builder__total" aria-live="polite">
                <span class="mall-builder__total-label">Total a pagar</span>
                <span class="mall-builder__total-amount" data-mall-total>$0</span>
                <span class="mall-builder__total-count" data-mall-count></span>
            </p>
            <p class="mall-builder__error" data-mall-error hidden>Marca al menos un comercio hijo para crear la transacción.</p>
            <button type="submit" class="mall-builder__submit" @if (count($childCommerceCodes) === 0) disabled @endif>Crear transacción mall</button>
        </div>
    </form>
</div>

<script>
    (function () {
        var form = document.querySelector('[data-mall-builder]');
        if (!form) return;

        var children = form.querySelectorAll('[data-mall-child]');
        var totalView = form.querySelector('[data-mall-total]');
        var countView = form.querySelector('[data-mall-count]');
        var errorView = form.querySelector('[data-mall-error]');
        var money = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP', maximumFractionDigits: 0 });

        function refresh() {
            var total = 0;
            var active = 0;
            Array.prototype.forEach.call(children, function (child) {
                var isActive = child.querySelector('[data-mall-child-active]').checked;
                child.classList.toggle('is-inactive', !isActive);
                // Un comercio desmarcado no se envía, así que no debe bloquear el formulario con sus campos.
                Array.prototype.forEach.call(child.querySelectorAll('input:not([type=checkbox])'), function (input) {
                    input.required = isActive;
                });
                if (isActive) {
                    active++;
                    total += parseInt(child.querySelector('[data-mall-child-amount]').value, 10) || 0;
                }
            });
            totalView.textContent = money.format(total);
            countView.textContent = active === 1 ? '1 comercio' : active + ' comercios';
            if (active > 0) errorView.hidden = true;
            return active;
        }

        form.addEventListener('input', refresh);
        form.addEventListener('change', refresh);
        form.addEventListener('submit', function (event) {
            if (refresh() === 0) {
                event.preventDefault();
                errorView.hidden = false;
            }
        });

        refresh();
    })();
</script>
@endsection
