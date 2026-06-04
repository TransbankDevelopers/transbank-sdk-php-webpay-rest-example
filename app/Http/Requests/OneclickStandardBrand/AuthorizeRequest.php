<?php

namespace App\Http\Requests\OneclickStandardBrand;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'tbk_user' => 'required|string|max:255',
            'buy_order' => 'required|string|max:26',
            'pos_entry_mode' => 'required|in:010,100,810',
            'request_3ds_authentication' => 'required|in:SI,NO',
            'details.0.amount' => 'required|integer|min:1',
            'details.0.buy_order' => 'required|string|max:26',
            'details.0.commerce_code' => 'required|string|max:12',
            'details.0.pmnt_ind' => 'nullable|in:C,R, ',
            'details.0.recur_pmnt' => 'nullable|in:F,V, ',
            'details.0.tid' => 'nullable|string|max:255',
            'details.0.browserAcceptHeader' => 'required|string|max:512',
            'details.0.browserUserAgent' => 'required|string|max:512',
            'details.0.browserIP' => 'required|ip',
            'details.0.browserJavaEnabled' => 'nullable',
            'details.0.browserScreenHeight' => 'required|integer|min:1|max:10000',
            'details.0.browserScreenWidth' => 'required|integer|min:1|max:10000',
            'details.0.browserTZ' => 'required|integer|min:-840|max:840',
            'details.0.browserJavascriptEnabled' => 'nullable',
            'details.0.installments_number' => 'required|integer|min:0|max:99',
        ];
    }
}
