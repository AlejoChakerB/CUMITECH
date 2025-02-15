<?php

namespace App\Http\Requests\API;

use App\Models\log_blood_bank;
use InfyOm\Generator\Request\APIRequest;

class Updatelog_blood_bankAPIRequest extends APIRequest
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
        $rules = log_blood_bank::$rules;
        
        return $rules;
    }
}
