<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class imaging_production_month
 * @package App\Models
 * @version April 3, 2024, 10:05 am -05
 *
 * @property string $service
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
 * @property integer $duration
 * @property integer $total_duration
 * @property integer $cups
 */
class imaging_production_month extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imaging_production_months';
    
    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'cups');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'service',
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
        'duration',
        'total_duration',
        'cups',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service' => 'string',
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
        'duration' => 'integer',
        'total_duration' => 'integer',
        'cups' => 'integer',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'period' => 'required',
        'january' => 'required',
        'cups' => 'required'
    ];

    
}
