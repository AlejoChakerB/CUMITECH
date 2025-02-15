<?php

namespace App\Http\Requests\API;

use App\Models\multiple_surgery;
use InfyOm\Generator\Request\APIRequest;

class Updatemultiple_surgeryAPIRequest extends APIRequest
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
        $rules = multiple_surgery::$rules;
        
        return $rules;
    }
}
