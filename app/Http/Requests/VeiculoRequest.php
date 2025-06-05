<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
{
    return [
        'placa' => ['required', 'regex:/^[A-Z]{3}[0-9]{4}$/'],
        'ano' => ['required', 'digits_between:1,4', 'numeric'],
        'modelo' => ['nullable', 'string'],
        'marca' => ['nullable', 'string'],
        'renavam' => ['nullable', 'string'],
        'proprietario' => ['nullable', 'exists:usuarios,id'],
    ];
}

}
