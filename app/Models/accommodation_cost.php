<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\log_accommodation_cost;

/**
 * Class accommodation_cost
 * @package App\Models
 * @version April 9, 2024, 11:21 am -05
 *
 * @property string $year
 * @property string $month
 * @property string $service
 * @property integer $bedrooms
 * @property integer $beds
 * @property integer $days_produced
 * @property number $hours_produced
 * @property number $minutes_produced
 * @property number $permanent_overhead
 * @property number $variable_overhead
 * @property number $administrative_twoLevel
 * @property number $logistic_twoLevel
 * @property number $plant_labour
 * @property number $labour
 * @property number $total_cost
 * @property number $daily_cost
 * @property number $bedxday_cost
 * @property number $hourAccommodation_cost
 * @property number $bedxhour_cost
 * @property number $bedxminute_cost
 */
class accommodation_cost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'accommodation_costs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'year',
        'month',
        'cost_center',
        'service',
        'bedrooms',
        'beds',
        'days_produced',
        'hours_produced',
        'minutes_produced',
        'permanent_overhead',
        'variable_overhead',
        'administrative_twoLevel',
        'logistic_twoLevel',
        'plant_labour',
        'labour',
        'total_cost',
        'daily_cost',
        'bedxday_cost',
        'dayAccommodation_cost',        
        'hourAccommodation_cost',
        'bedxhour_cost',
        'bedxminute_cost'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'year' => 'string',
        'month' => 'string',
        'cost_center' => 'string',
        'service' => 'string',
        'bedrooms' => 'integer',
        'beds' => 'integer',
        'days_produced' => 'integer',
        'hours_produced' => 'decimal:2',
        'minutes_produced' => 'decimal:2',
        'permanent_overhead' => 'decimal:2',
        'variable_overhead' => 'decimal:2',
        'administrative_twoLevel' => 'decimal:2',
        'logistic_twoLevel' => 'decimal:2',
        'plant_labour' => 'decimal:2',
        'labour' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'daily_cost' => 'decimal:2',
        'bedxday_cost' => 'decimal:2',
        'dayAccommodation_cost' => 'decimal:2',
        'hourAccommodation_cost' => 'decimal:2',
        'bedxhour_cost' => 'decimal:2',
        'bedxminute_cost' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'year' => 'required',
        'month' => 'required',
        'cost_center' => 'required',
        'service' => 'required',
        'bedrooms' => 'required',
        'permanent_overhead' => 'required',
        'days_produced' => 'required',
        'variable_overhead' => 'required',
        'administrative_twoLevel' => 'required',
        'logistic_twoLevel' => 'required',
        'plant_labour' => 'required',
        'labour' => 'required'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $oldData = $model->getOriginal();
            $newData = $model->getAttributes();

            if ($oldData !== $newData) {
                $changedFields = array_keys(array_diff_assoc($newData, $oldData));
                $observation = 'Cambio en: ' . implode(', ', $changedFields);

                $historia = new log_accommodation_cost([
                    'id_accommodation' => $model->id,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_accommodation_cost()->save($historia);
            }
        });
    }

    public function log_accommodation_cost()
    {
        return $this->hasMany(log_accommodation_cost::class, 'id_accommodation', 'id');
    }
    
}
