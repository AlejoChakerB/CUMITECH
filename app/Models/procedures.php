<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class procedures
 * @package App\Models
 * @version November 30, 2023, 2:48 pm -05
 *
 * @property string $code
 * @property string $manual_type
 * @property string $description
 * @property string $cups
 * @property integer $uvr
 * @property number $procedure_value
 */
class procedures extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'procedures';

    public function diferential_rates()
    {
        return $this->hasMany(Diferential_rates::class);
    }

    public function msurgery_procedure()
    {
        return $this->hasMany(Msurgery_procedure::class);
    }

    public function imaging_production()
    {
        return $this->hasMany(Imaging_production::class,'id', 'cups');
    }

    public function cumiLab_rate()
    {
        return $this->hasMany(Imaging_production::class,'code', 'cups');
    }

    public function imaging_production_month()
    {
        return $this->hasMany(Imaging_production_month::class,'cups');
    }

    public function cext_details()
    {
        return $this->hasMany(cext_details::class,'code', 'procedure');
    }

    public function imaging_production_details()
    {
        return $this->hasMany(Imaging_production_details::class,'code', 'cups');
    }

    public function blood_bank_month()
    {
        return $this->hasMany(Blood_bank_month::class,'code', 'cups');
    }

    public function procedures()
    {
        return $this->hasMany(Procedures::class);
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'manual_type',
        'description',
        'cups',
        'rips',
        'uvr',
        'uvt',
        'value',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'manual_type' => 'string',
        'description' => 'string',
        'cups' => 'string',
        'uvr' => 'integer',
        'uvt' => 'decimal:2',
        'value' => 'decimal:2',
        'category' => 'string'
        
        /* 'procedure_value' => 'decimal:2' */
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'manual_type' => 'required',
        'description' => 'required',
        'cups' => 'required',
        'uvr' => 'required'
        /* 'procedure_value' => 'required' */
    ];

    
}
