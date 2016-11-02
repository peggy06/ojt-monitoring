<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistrationRequest extends Request
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
        return [
            'firstname' => 'required|min:2',
            'lastname'  => 'required|min:2',
            'email'     => 'required|email|unique:users',
            'contact'   => 'required|min:10|max:10|unique:profiles',
            'gender'    => 'required',
            'signature' => 'required',
            'bday'      => 'required|date'
        ];
    }
}
