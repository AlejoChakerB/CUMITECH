<?php

namespace App\Http\Requests\API;

use App\Models\detail_packages_temp;
use InfyOm\Generator\Request\APIRequest;

class Updatedetail_packages_tempAPIRequest extends APIRequest
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
        $rules = detail_packages_temp::$rules;
        
        return $rules;
    }
}
