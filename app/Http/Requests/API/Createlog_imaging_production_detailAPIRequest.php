<?php

namespace App\Http\Requests\API;

use App\Models\log_imaging_production_detail;
use InfyOm\Generator\Request\APIRequest;

class Createlog_imaging_production_detailAPIRequest extends APIRequest
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
        return log_imaging_production_detail::$rules;
    }
}
