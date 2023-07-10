<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialAccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => "required|min:2|max:255",
            'type' => 'required|boolean',
            'status' => 'required|boolean',
        ];
    }
    public function attributes(): array
    {
        return [
            'description' => "[Descrição]",
            'type' => '[Tipo]',
            'status' => '[status]',
        ];
    }
}
