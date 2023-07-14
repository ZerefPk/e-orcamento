<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetUnitRequest extends FormRequest
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
        return  [
            'acronym' => 'required|min:2|max:10|unique:budget_units,acronym,'.$this->acronym,
            'description' => 'required|min:2|max:255',
            'status' => 'required|boolean'
        ];
    }

    public function attributes(): array
    {
        return  [
            'acronym' => '[Sigla]',
            'description' => '[Descrição]',
            'status' => '[Status]'
        ];
    }
}
