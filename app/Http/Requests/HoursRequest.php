<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HoursRequest extends Request
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
            'hours' => 'required|min:450|max:600|integer'
        ];
    }
}
