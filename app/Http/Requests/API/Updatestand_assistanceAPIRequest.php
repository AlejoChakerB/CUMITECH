<?php

namespace App\Http\Requests\API;

use App\Models\stand_assistance;
use InfyOm\Generator\Request\APIRequest;

class Updatestand_assistanceAPIRequest extends APIRequest
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
        $rules = stand_assistance::$rules;
        
        return $rules;
    }
}
