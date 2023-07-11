<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProjectRequest extends FormRequest
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
            'cod' => 'required|min:2|unique:projects,cod,'.$this->cod,
            'description' => 'required|min:2|max:255',
            'status' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return  [
            'cod' => '[Código]',
            'description' => '[Nome do Projeto]',
            'status' => '[Status]',
        ];
    }
}
