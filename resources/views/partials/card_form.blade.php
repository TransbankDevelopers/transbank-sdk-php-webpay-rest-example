{{--
    Formulario de tarjeta interactivo para Transacción Completa.

    Parámetros (todos opcionales):
      format    'MM/YY' (por defecto) o 'YY/MM': formato en que se envía card_expiration_date.
      withCvv   true (por defecto) para pedir CVV y mostrar el reverso de la tarjeta.
      required  marca los campos como obligatorios en el navegador.
      defaults  ['number' => ..., 'expiration' => ..., 'cvv' => ...] valores iniciales.

    Envía los mismos campos que antes: card_number (solo dígitos), card_expiration_date y cvv.
--}}
@php
    $format = ($format ?? 'MM/YY') === 'YY/MM' ? 'YY/MM' : 'MM/YY';
    $withCvv = $withCvv ?? true;
    $required = $required ?? false;
    $defaults = $defaults ?? [];
    $formatLabel = $format === 'YY/MM' ? 'AA/MM' : 'MM/AA';
    $expirationPattern = $format === 'YY/MM' ? '^\d{2}\/(0[1-9]|1[0-2])$' : '^(0[1-9]|1[0-2])\/\d{2}$';
@endphp
<link rel="stylesheet" href="{{ \App\Support\AssetVersion::url('css/card-form.css') }}">

<div class="tbk-card-wrap">
<div class="tbk-card" data-card-form data-exp-format="{{ $format }}">
    <div class="tbk-card__stage" aria-hidden="true">
        <div class="tbk-card__inner">
            <div class="tbk-card__face tbk-card__face--front">
                <div class="tbk-card__top">
                    <svg class="tbk-card__chip" viewBox="0 0 46 34" focusable="false">
                        <rect x="0.5" y="0.5" width="45" height="33" rx="6" fill="#e5c983" stroke="#b8974f"/>
                        <path d="M0.5 12h14M0.5 22h14M31.5 12h14M31.5 22h14M14.5 0.5v33M31.5 0.5v33M14.5 17h17" stroke="#b8974f" fill="none"/>
                    </svg>
                    <span class="tbk-card__brand" data-card-brand></span>
                </div>

                <div class="tbk-card__number" data-card-slot="number">
                    <span data-card-number>•••• •••• •••• ••••</span>
                </div>

                <div class="tbk-card__bottom">
                    <div class="tbk-card__slot" data-card-slot="exp">
                        <span class="tbk-card__caption">Vence</span>
                        <span class="tbk-card__value" data-card-exp>MM/AA</span>
                    </div>
                    @if ($withCvv)
                        <div class="tbk-card__slot tbk-card__slot--front-cvv" data-card-slot="cvv-front">
                            <span class="tbk-card__caption">CID</span>
                            <span class="tbk-card__value" data-card-cvv-front>••••</span>
                        </div>
                    @endif
                </div>
            </div>

            @if ($withCvv)
                <div class="tbk-card__face tbk-card__face--back">
                    <div class="tbk-card__stripe"></div>
                    <div class="tbk-card__signature">
                        <span class="tbk-card__signature-lines"></span>
                        <span class="tbk-card__cvv" data-card-slot="cvv">
                            <span class="tbk-card__caption tbk-card__caption--dark">CVV</span>
                            <span data-card-cvv>•••</span>
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="tbk-card__fields">
        <div class="tbk-card__field">
            <label for="card_number">Número de tarjeta</label>
            <input
                id="card_number"
                type="text"
                inputmode="numeric"
                autocomplete="cc-number"
                placeholder="0000 0000 0000 0000"
                value="{{ $defaults['number'] ?? '' }}"
                data-card-input="number"
                {{ $required ? 'required' : '' }}
            >
            <input type="hidden" name="card_number" value="{{ preg_replace('/\D/', '', $defaults['number'] ?? '') }}" data-card-hidden-number>
        </div>

        <div class="tbk-card__row">
            <div class="tbk-card__field">
                <label for="card_expiration_date">Vencimiento <span class="tbk-card__hint">({{ $formatLabel }})</span></label>
                <input
                    id="card_expiration_date"
                    name="card_expiration_date"
                    type="text"
                    inputmode="numeric"
                    autocomplete="off"
                    placeholder="{{ $formatLabel }}"
                    maxlength="5"
                    pattern="{{ $expirationPattern }}"
                    title="Usa el formato {{ $formatLabel }}"
                    value="{{ $defaults['expiration'] ?? '' }}"
                    data-card-input="exp"
                    {{ $required ? 'required' : '' }}
                >
            </div>

            @if ($withCvv)
                <div class="tbk-card__field">
                    <label for="cvv">CVV</label>
                    <input
                        id="cvv"
                        name="cvv"
                        type="text"
                        inputmode="numeric"
                        autocomplete="cc-csc"
                        placeholder="123"
                        maxlength="4"
                        value="{{ $defaults['cvv'] ?? '' }}"
                        data-card-input="cvv"
                        {{ $required ? 'required' : '' }}
                    >
                </div>
            @endif
        </div>

        <p class="tbk-card__sr" aria-live="polite" data-card-announce></p>
    </div>
</div>
</div>

<script src="{{ \App\Support\AssetVersion::url('js/card-form.js') }}" defer></script>
