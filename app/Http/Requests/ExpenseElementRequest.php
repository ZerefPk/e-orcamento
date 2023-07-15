<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseElementRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'account' => 'required',
            'csv' => 'file|required|mimes:csv',
            'delimiter' => 'required',
        ];
    }

    public function attributes(): array {
        return [
            'account' => '[Conta Contábil]',
            'csv' => '[Arquivo de Contas]',
            'delimiter' => '[Delimitador]',
        ];
    }
}
