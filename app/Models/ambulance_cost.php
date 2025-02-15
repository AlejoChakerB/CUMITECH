<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\log_ambulance_cost;

/**
 * Class ambulance_cost
 * @package App\Models
 * @version April 23, 2024, 3:40 pm -05
 *
 * @property string $CUPS
 * @property string $name
 * @property number $value
 * @property number $recharge
 */
class ambulance_cost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ambulance_costs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cups',
        'name',
        'value',
        'recharge'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cups' => 'string',
        'name' => 'string',
        'value' => 'decimal:2',
        'recharge' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cups' => 'required',
        'name' => 'required',
        'value' => 'required'
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

                $historia = new log_ambulance_cost([
                    'cups' => $model->cups,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_ambulance_cost()->save($historia);
            }
        });
    }

    public function log_ambulance_cost()
    {
        return $this->hasMany(log_ambulance_cost::class, 'cups', 'cups');
    }
}
