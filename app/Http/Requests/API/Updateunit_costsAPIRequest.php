<?php

namespace App\Http\Requests\API;

use App\Models\unit_costs;
use InfyOm\Generator\Request\APIRequest;

class Updateunit_costsAPIRequest extends APIRequest
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
        $rules = unit_costs::$rules;
        
        return $rules;
    }
}
