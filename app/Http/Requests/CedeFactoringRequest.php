<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CedeFactoringRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required','exists:invoices,id'],
            'advance_rate' => ['required','numeric','min:0','max:100'],
            'fee_rate' => ['required','numeric','min:0','max:100'],
        ];
    }
}
