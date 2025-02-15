<?php

namespace App\Http\Requests\API;

use App\Models\cext_hourcost;
use InfyOm\Generator\Request\APIRequest;

class Createcext_hourcostAPIRequest extends APIRequest
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
        return cext_hourcost::$rules;
    }
}
