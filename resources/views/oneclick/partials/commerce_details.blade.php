<div class="oneclick-details" data-oneclick-details>
    <h3>Comercios hijos</h3>
    <p class="oneclick-details__description">Agrega una fila por comercio. Cada orden hija se genera automáticamente y cada monto parte en 1000.</p>
    <div class="oneclick-details__list" data-detail-list>
        <fieldset class="oneclick-details__row" data-detail-row>
            <legend>Comercio hijo 1</legend>
            <label for="detail-commerce-code-0">Código de comercio hijo</label>
            @if (app()->environment('production'))
                <input id="detail-commerce-code-0" name="details[0][commerce_code]" type="text" value="{{ config('services.transbank.oneclick_mall_child_cc') }}" required>
            @else
                <select id="detail-commerce-code-0" name="details[0][commerce_code]" required>
                    <option value="597055555542">Comercio 1 - 597055555542</option>
                    <option value="597055555543">Comercio 2 - 597055555543</option>
                </select>
            @endif

            <label for="detail-buy-order-0">Orden de compra hija</label>
            <input id="detail-buy-order-0" name="details[0][buy_order]" value="{{ 'child-' . rand(100000000, 999999999) }}" maxlength="26" required>

            <label for="detail-amount-0">Monto</label>
            <input id="detail-amount-0" name="details[0][amount]" type="number" value="1000" min="1" step="1" required>

            <label for="detail-installments-0">Cantidad de cuotas</label>
            <select id="detail-installments-0" name="details[0][installments_number]" required>
                @for ($installments = 1; $installments <= 6; $installments++)
                    <option value="{{ $installments }}">{{ $installments }}</option>
                @endfor
            </select>
            <button class="oneclick-details__remove" type="button" data-remove-detail disabled>Quitar comercio</button>
        </fieldset>
    </div>

    <button class="oneclick-details__add" type="button" data-add-detail>Agregar comercio hijo</button>

    <template data-detail-template>
        <fieldset class="oneclick-details__row" data-detail-row>
            <legend>Comercio hijo __INDEX_LABEL__</legend>
            <label for="detail-commerce-code-__INDEX__">Código de comercio hijo</label>
            @if (app()->environment('production'))
                <input id="detail-commerce-code-__INDEX__" name="details[__INDEX__][commerce_code]" type="text" value="" required>
            @else
                <select id="detail-commerce-code-__INDEX__" name="details[__INDEX__][commerce_code]" required>
                    <option value="597055555542">Comercio 1 - 597055555542</option>
                    <option value="597055555543">Comercio 2 - 597055555543</option>
                </select>
            @endif

            <label for="detail-buy-order-__INDEX__">Orden de compra hija</label>
            <input id="detail-buy-order-__INDEX__" name="details[__INDEX__][buy_order]" value="" maxlength="26" required>

            <label for="detail-amount-__INDEX__">Monto</label>
            <input id="detail-amount-__INDEX__" name="details[__INDEX__][amount]" type="number" value="1000" min="1" step="1" required>

            <label for="detail-installments-__INDEX__">Cantidad de cuotas</label>
            <select id="detail-installments-__INDEX__" name="details[__INDEX__][installments_number]" required>
                @for ($installments = 1; $installments <= 6; $installments++)
                    <option value="{{ $installments }}">{{ $installments }}</option>
                @endfor
            </select>
            <button class="oneclick-details__remove" type="button" data-remove-detail>Quitar comercio</button>
        </fieldset>
    </template>
</div>

<script>
    (function () {
        document.querySelectorAll('[data-oneclick-details]').forEach(function (container) {
            var list = container.querySelector('[data-detail-list]');
            var template = container.querySelector('[data-detail-template]');
            var nextIndex = 1;

            function updateRows() {
                var rows = list.querySelectorAll('[data-detail-row]');
                rows.forEach(function (row, index) {
                    row.querySelector('legend').textContent = 'Comercio hijo ' + (index + 1);
                    row.querySelector('[data-remove-detail]').disabled = rows.length === 1;
                });
            }

            container.querySelector('[data-add-detail]').addEventListener('click', function () {
                var index = nextIndex++;
                var html = template.innerHTML
                    .replace(/__INDEX__/g, index)
                    .replace(/__INDEX_LABEL__/g, index + 1);
                var wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                var row = wrapper.firstElementChild;
                row.querySelector('[name="details[' + index + '][buy_order]"]').value =
                    'child-' + Date.now() + '-' + index;
                list.appendChild(row);
                updateRows();
            });

            list.addEventListener('click', function (event) {
                var removeButton = event.target.closest('[data-remove-detail]');
                if (removeButton && !removeButton.disabled) {
                    removeButton.closest('[data-detail-row]').remove();
                    updateRows();
                }
            });
        });
    })();
</script>
