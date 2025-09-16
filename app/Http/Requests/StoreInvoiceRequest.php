<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required','exists:clients,id'],
            'number' => ['required','string','max:100'],
            'issue_date' => ['required','date'],
            'due_date' => ['required','date','after_or_equal:issue_date'],
            'gross_amount' => ['required','numeric','min:0.01'],
        ];
    }
}
