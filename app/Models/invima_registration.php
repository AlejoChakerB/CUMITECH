<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class invima_registration
 * @package App\Models
 * @version August 28, 2023, 10:04 am -05
 *
 * @property string $generic_name
 * @property string $tradename
 * @property string $health_register
 * @property string $state_invima
 * @property string $validity_registration
 * @property string $laboratory_manufacturer
 * @property string $pharmaceutical_form
 */

class invima_registration extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'invima_registrations';
    

    public function medicine()
    {
        return $this->hasMany(Medicine::class);
    }

    public function medicationTemplate()
    {
        return $this->hasMany(medicationTemplate::class);
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'generic_name',
        'tradename',
        'health_register',
        'state_invima',
        'validity_registration',
        'laboratory_manufacturer',
        'pharmaceutical_form'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'generic_name' => 'string',
        'tradename' => 'string',
        'health_register' => 'string',
        'state_invima' => 'string',
        'validity_registration' => 'string',
        'laboratory_manufacturer' => 'string',
        'pharmaceutical_form' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'generic_name' => 'required',
        'tradename' => 'required',
        'health_register' => 'required',
        'state_invima' => 'required',
        'validity_registration' => 'required',
        'laboratory_manufacturer' => 'required',
        'pharmaceutical_form' => 'required'
    ];

    
}
