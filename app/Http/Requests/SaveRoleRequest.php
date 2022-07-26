<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRoleRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'display_name' => 'required',
            'guard_name' => 'required'
        ];

        if ($this->method() == 'POST')
            $rules['name'] = 'required|unique:roles';

        return $rules;
    }

    public function messages() {

        return [
            'name.required' => 'El idenfiticador es obligatorio',
            'name.unique' => 'El idenfiticador es esta registrado',
            'display_name.required' => 'El nombre es obligatorio',
            'guard_name.required' => 'El guard es obligatorio',
        ];
    }
}
