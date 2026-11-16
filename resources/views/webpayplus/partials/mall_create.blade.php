{{--
    Formulario de creación de los productos Webpay Plus Mall.
    Parámetros:
      $title, $intro, $action
      $buyOrder, $sessionId, $returnUrl   datos del comercio padre
      $children     lista de ['code' => ..., 'buyOrder' => ..., 'amount' => ..., 'label' => (opcional)]
      $selectable   true solo si el controlador descarta los comercios sin detail[i][active]
      $emptyHint    (opcional) texto cuando no hay comercios hijos configurados
--}}
@php($selectable = $selectable ?? false)
<div class="w-full max-w-none">
    <h1 class="mb-2">{{ $title }}</h1>
    <p class="text-gray-700 mb-6">{{ $intro }}</p>

    <form action="{{ url($action) }}" method="post" class="tbk-form-stack-lg mall-builder" data-mall-builder>
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Comercio padre</h3>
            <div class="mall-builder__grid">
                <div class="mall-builder__field">
                    <label for="parent_merchant_buy_order">Orden de compra</label>
                    <input id="parent_merchant_buy_order" name="buy_order" type="text" maxlength="26" value="{{ $buyOrder }}" required autocomplete="off">
                </div>

                <div class="mall-builder__field">
                    <label for="session_id_parent">Id de sesión</label>
                    <input id="session_id_parent" name="session_id" type="text" maxlength="61" value="{{ $sessionId }}" required autocomplete="off">
                </div>

                <div class="mall-builder__field mall-builder__field--wide">
                    <label for="return_url">URL de retorno</label>
                    <input id="return_url" name="return_url" type="url" value="{{ $returnUrl }}" required>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-1">Comercios hijos</h3>
            <p class="mall-builder__hint">
                {{ $selectable ? 'Solo se envían los comercios marcados. Cada uno necesita su propia orden de compra.' : 'Cada comercio hijo necesita su propia orden de compra.' }}
            </p>

            @forelse ($children as $i => $child)
                <fieldset class="mall-child" data-mall-child>
                    <legend class="mall-child__legend">
                        @if ($selectable)
                            <label class="mall-child__toggle">
                                <input type="checkbox" name="detail[{{ $i }}][active]" value="1" checked data-mall-child-active>
                                <span>{{ $child['label'] ?? 'Comercio ' . ($i + 1) }}</span>
                                <span class="mall-child__code">{{ $child['code'] }}</span>
                            </label>
                        @else
                            <span class="mall-child__toggle">
                                <span>{{ $child['label'] ?? 'Comercio ' . ($i + 1) }}</span>
                                <span class="mall-child__code">{{ $child['code'] }}</span>
                            </span>
                        @endif
                    </legend>

                    <div class="mall-builder__grid mall-builder__grid--three">
                        <div class="mall-builder__field">
                            <label for="merchant_{{ $i }}_commerce_code">Código de comercio</label>
                            <input id="merchant_{{ $i }}_commerce_code" name="detail[{{ $i }}][commerce_code]" type="text" maxlength="12" value="{{ $child['code'] }}" required autocomplete="off">
                        </div>

                        <div class="mall-builder__field">
                            <label for="merchant_{{ $i }}_buy_order">Orden de compra</label>
                            <input id="merchant_{{ $i }}_buy_order" name="detail[{{ $i }}][buy_order]" type="text" maxlength="26" value="{{ $child['buyOrder'] }}" required autocomplete="off">
                        </div>

                        <div class="mall-builder__field">
                            <label for="merchant_{{ $i }}_amount">Monto</label>
                            <input id="merchant_{{ $i }}_amount" name="detail[{{ $i }}][amount]" type="number" min="1" step="1" inputmode="numeric" value="{{ $child['amount'] }}" required data-mall-child-amount>
                        </div>
                    </div>
                </fieldset>
            @empty
                <p class="mall-builder__empty">{!! $emptyHint ?? 'No hay comercios hijos configurados.' !!}</p>
            @endforelse
        </div>

        <div class="mall-builder__footer">
            <p class="mall-builder__total" aria-live="polite">
                <span class="mall-builder__total-label">Total a pagar</span>
                <span class="mall-builder__total-amount" data-mall-total>$0</span>
                <span class="mall-builder__total-count" data-mall-count></span>
            </p>
            <p class="mall-builder__error" data-mall-error hidden>Marca al menos un comercio hijo para crear la transacción.</p>
            <button type="submit" class="mall-builder__submit" @if (count($children) === 0) disabled @endif>Crear transacción mall</button>
        </div>
    </form>
</div>

<script src="{{ \App\Support\AssetVersion::url('js/mall-builder.js') }}" defer></script>
