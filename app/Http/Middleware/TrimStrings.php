<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
        'recur_pmnt',
        'details.0.pmnt_ind',
        'details.0.recur_pmnt',
        'details.*.recur_pmnt',
    ];
}
