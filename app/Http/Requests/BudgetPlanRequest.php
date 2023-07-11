<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetPlanRequest extends FormRequest
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
        //dd(['name' => 'required|min:2|max:50|unique:budget_plans,name,"'.$this->name]);
        return [
            'name' => 'required|min:2|max:50',
            'beginning_term' => 'required',
            'end_period' =>  'required',
            'status' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '[Nome do Plano]',
            'beginning_term' => '[Data de Inicio]',
            'end_period' =>  '[Data de Término]',
            'status' => '[Status]',
        ];
    }
}
