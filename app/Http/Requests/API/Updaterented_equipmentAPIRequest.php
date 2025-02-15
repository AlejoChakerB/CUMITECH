<?php

namespace App\Http\Requests\API;

use App\Models\rented_equipment;
use InfyOm\Generator\Request\APIRequest;

class Updaterented_equipmentAPIRequest extends APIRequest
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
        $rules = rented_equipment::$rules;
        
        return $rules;
    }
}
