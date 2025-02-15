<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class imaging_production_hourcost
 * @package App\Models
 * @version April 4, 2024, 12:02 pm -05
 *
 * @property string $service
 * @property number $permanent_overhead
 * @property number $variable_overhead
 * @property number $administrative_twoLevel
 * @property number $logistic_twoLevel
 * @property number $plant_labour
 * @property number $labour
 * @property number $total_cost
 * @property number $employee
 * @property number $hour_value
 * @property integer $number_rooms
 * @property number $hour_value_room
 */
class imaging_production_hourcost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imaging_production_hourcosts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'service',
        'permanent_overhead',
        'variable_overhead',
        'administrative_twoLevel',
        'logistic_twoLevel',
        'plant_labour',
        'supplies',
        'total_cost',
        'employee',
        'hour_value',
        'number_rooms',
        'hour_value_room'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service' => 'string',
        'permanent_overhead' => 'decimal:2',
        'variable_overhead' => 'decimal:2',
        'administrative_twoLevel' => 'decimal:2',
        'logistic_twoLevel' => 'decimal:2',
        'plant_labour' => 'decimal:2',
        'supplies' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'employee' => 'decimal:2',
        'hour_value' => 'decimal:2',
        'number_rooms' => 'integer',
        'hour_value_room' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service' => 'required',
        'permanent_overhead' => 'required',
        'variable_overhead' => 'required',
        'administrative_twoLevel' => 'required',
        'logistic_twoLevel' => 'required',
        'plant_labour' => 'required',
        'supplies' => 'required',
        'employee' => 'required',
        'number_rooms' => 'required',
    ];

    
}
