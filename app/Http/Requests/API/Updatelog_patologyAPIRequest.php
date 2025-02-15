<?php

namespace App\Http\Requests\API;

use App\Models\log_patology;
use InfyOm\Generator\Request\APIRequest;

class Updatelog_patologyAPIRequest extends APIRequest
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
        $rules = log_patology::$rules;
        
        return $rules;
    }
}
