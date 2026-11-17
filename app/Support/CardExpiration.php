<?php

namespace App\Support;

/**
 * Vencimiento de tarjeta: los formularios lo piden en formato chileno MM/AA (como viene impreso en la tarjeta)
 * y la API de Transbank lo espera como AA/MM.
 */
class CardExpiration
{
    /** Regla de validación para el formato del formulario (MM/AA). */
    public const FORM_REGEX = '/^(0[1-9]|1[0-2])\/\d{2}$/';

    /**
     * Convierte MM/AA (12/30) a AA/MM (30/12). Si el valor no viene como MM/AA, lo devuelve tal cual
     * para que la API responda con su propio mensaje de error.
     */
    public static function toApi(?string $value): ?string
    {
        if ($value === null || !preg_match(self::FORM_REGEX, $value)) {
            return $value;
        }

        [$month, $year] = explode('/', $value);

        return $year . '/' . $month;
    }
}
