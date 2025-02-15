<?php

namespace App\Http\Requests\API;

use App\Models\cumi_lab_historic;
use InfyOm\Generator\Request\APIRequest;

class Createcumi_lab_historicAPIRequest extends APIRequest
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
        return cumi_lab_historic::$rules;
    }
}
