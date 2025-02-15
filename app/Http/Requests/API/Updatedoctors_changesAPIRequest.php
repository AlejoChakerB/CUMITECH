<?php

namespace App\Http\Requests\API;

use App\Models\doctors_changes;
use InfyOm\Generator\Request\APIRequest;

class Updatedoctors_changesAPIRequest extends APIRequest
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
        $rules = doctors_changes::$rules;
        
        return $rules;
    }
}
