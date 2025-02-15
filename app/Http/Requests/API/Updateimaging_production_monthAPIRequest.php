<?php

namespace App\Http\Requests\API;

use App\Models\imaging_production_month;
use InfyOm\Generator\Request\APIRequest;

class Updateimaging_production_monthAPIRequest extends APIRequest
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
        $rules = imaging_production_month::$rules;
        
        return $rules;
    }
}
