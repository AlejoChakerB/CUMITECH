<?php

namespace App\Http\Requests\API;

use App\Models\log_details_unitCost;
use InfyOm\Generator\Request\APIRequest;

class Updatelog_details_unitCostAPIRequest extends APIRequest
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
        $rules = log_details_unitCost::$rules;
        
        return $rules;
    }
}
