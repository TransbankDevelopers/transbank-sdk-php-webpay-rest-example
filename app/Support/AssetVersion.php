<?php

namespace App\Support;

/**
 * URL de un archivo de public/ con su fecha de modificación como versión (?v=...).
 * Cuando el archivo cambia, la URL cambia y el navegador descarga la versión nueva en vez de usar la caché.
 */
class AssetVersion
{
    public static function url(string $path): string
    {
        $file = public_path($path);

        return asset($path) . (is_file($file) ? '?v=' . filemtime($file) : '');
    }
}
