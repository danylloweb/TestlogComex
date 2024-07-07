<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string',
            'description' => 'required|string',
            'price'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'Campo Nome Obrigatório',
            'name.string'         => 'Formato Incorreto do nome',
            'description.required'=> 'Campo Descrição Obrigatório',
            'description.string'  => 'Formato Incorreto da descrição',
            'price.required'      => 'Preço é Obrigatório',
        ];
    }
}
