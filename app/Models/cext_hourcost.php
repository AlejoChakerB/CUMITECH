<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class cext_hourcost
 * @package App\Models
 * @version April 12, 2024, 8:54 am -05
 *
 * @property number $permanent_overhead
 * @property number $variable_overhead
 * @property number $administrative_twoLevel
 * @property number $logistic_twoLevel
 * @property number $plant_labour
 * @property number $labour
 * @property number $total_cost
 * @property integer $days_produced
 * @property number $hours_producedxday
 * @property number $hours_producedxmonth
 * @property number $room_valueTotal
 * @property number $room_value
 */
class cext_hourcost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cext_hourcosts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'permanent_overhead',
        'variable_overhead',
        'administrative_twoLevel',
        'logistic_twoLevel',
        'plant_labour',
        'labour',
        'total_cost',
        'days_produced',
        'hours_producedxday',
        'hours_producedxmonth',
        'room_valueTotal',
        'number_room',
        'room_value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'permanent_overhead' => 'decimal:2',
        'variable_overhead' => 'decimal:2',
        'administrative_twoLevel' => 'decimal:2',
        'logistic_twoLevel' => 'decimal:2',
        'plant_labour' => 'decimal:2',
        'labour' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'days_produced' => 'integer',
        'hours_producedxday' => 'decimal:2',
        'hours_producedxmonth' => 'decimal:2',
        'room_valueTotal' => 'decimal:2',
        'number_room' => 'integer',
        'room_value' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permanent_overhead' => 'required',
        'variable_overhead' => 'required',
        'administrative_twoLevel' => 'required',
        'logistic_twoLevel' => 'required',
        'plant_labour' => 'required',
        'labour' => 'required',
        'days_produced' => 'required'
    ];

    
}
