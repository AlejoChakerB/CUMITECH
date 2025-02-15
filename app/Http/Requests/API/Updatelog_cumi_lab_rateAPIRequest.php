<?php

namespace App\Http\Requests\API;

use App\Models\log_cumi_lab_rate;
use InfyOm\Generator\Request\APIRequest;

class Updatelog_cumi_lab_rateAPIRequest extends APIRequest
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
        $rules = log_cumi_lab_rate::$rules;
        
        return $rules;
    }
}
