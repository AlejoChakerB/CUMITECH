<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class cext_production_month
 * @package App\Models
 * @version April 12, 2024, 9:27 am -05
 *
 * @property string $specialty
 * @property string $period
 * @property number $january
 * @property number $february
 * @property number $march
 * @property number $april
 * @property number $may
 * @property number $june
 * @property number $july
 * @property number $august
 * @property number $september
 * @property number $october
 * @property number $november
 * @property number $december
 * @property number $average_months
 * @property number $average_months
 * @property integer $duration
 * @property integer $total_duration
 */
class cext_production_month extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cext_production_months';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'specialty',
        'period',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'average_months',
        'average_months',
        'duration',
        'total_duration'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'specialty' => 'string',
        'period' => 'string',
        'january' => 'decimal:2',
        'february' => 'decimal:2',
        'march' => 'decimal:2',
        'april' => 'decimal:2',
        'may' => 'decimal:2',
        'june' => 'decimal:2',
        'july' => 'decimal:2',
        'august' => 'decimal:2',
        'september' => 'decimal:2',
        'october' => 'decimal:2',
        'november' => 'decimal:2',
        'december' => 'decimal:2',
        'average_months' => 'decimal:2',
        'average_months' => 'decimal:2',
        'duration' => 'integer',
        'total_duration' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'specialty' => 'required',
        'period' => 'required'
    ];

    
}
