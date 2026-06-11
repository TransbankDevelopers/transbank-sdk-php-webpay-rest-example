<?php

namespace App\Http\Requests\TransaccionCompletaStandardBrandWithoutCvv;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buy_order' => 'required|string|max:26',
            'session_id' => 'required|string|max:255',
            'card_number' => ['required', 'string', 'regex:/^\d{12,19}$/'],
            'card_expiration_date' => ['required', 'string', 'regex:/^\d{2}\/(0[1-9]|1[0-2])$/'],
            'details.0.amount' => 'required|integer|min:1',
            'details.0.commerce_code' => 'required|string|max:12',
            'details.0.buy_order' => 'required|string|max:26',
            'details.0.post_entry_mod' => 'required|in:010,100,810',
            'details.0.eci' => 'nullable|in:01,02,05,06',
            'details.0.authentication_value' => 'nullable|string|max:255',
            'details.0.message_version' => 'nullable|string|max:255',
            'details.0.trans_status' => 'nullable|in:C,Y,A,N,R,D,U,I',
            'details.0.ds_trans_id' => 'nullable|string|max:255',
            'details.0.authentication_type' => 'nullable|in:C',
            'details.0.identify_initiated_trx' => 'nullable|in:0,1,2,3,4',
            'details.0.tid' => 'nullable|string|max:20',
            'details.0.pmnt_ind' => 'nullable|in:C,R',
            'details.0.recur_pmnt' => 'nullable|in:F,V',
        ];
    }

}
