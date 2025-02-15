<?php

namespace App\Http\Requests\API;

use App\Models\blood_bank_month;
use InfyOm\Generator\Request\APIRequest;

class Createblood_bank_monthAPIRequest extends APIRequest
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
        return blood_bank_month::$rules;
    }
}
