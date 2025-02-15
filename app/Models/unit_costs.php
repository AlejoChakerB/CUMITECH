<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\log_unit_cost;

/**
 * Class unit_costs
 * @package App\Models
 * @version December 1, 2023, 10:56 am -05
 *
 * @property number $room_cost
 * @property number $gas
 * @property number $total_value
 * @property number $consumables
 * @property number $basket
 * @property number $medical_fees
 * @property number $medical_fees2
 * @property number $anest_fees
 * @property integer $cod_surgical_act
 * @property string category
 */
class unit_costs extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'unit_costs';
    
    public function surgery()
    {
        return $this->belongsTo(Surgery::class, 'cod_surgical_act');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'room_cost',
        'gas',
        'total_value',
        'consumables',
        'basket',
        'rented',
        'medical_fees',
        'medical_fees2',
        'anest_fees',
        'dist_pack',
        'cod_surgical_act',
        'category',
        'mode',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_cost' => 'decimal:2',
        'gas' => 'decimal:2',
        'total_value' => 'decimal:2',
        'consumables' => 'decimal:2',
        'basket' => 'decimal:2',
        'rented' => 'decimal:2',
        'medical_fees' => 'decimal:2',
        'medical_fees2' => 'decimal:2',
        'anest_fees' => 'decimal:2',
        'dist_pack' => 'decimal:2',
        'cod_surgical_act' => 'integer',
        'category' => 'string',
        'mode' => 'string',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'room_cost' => 'required',
        'gas' => 'required',
        'consumables' => 'required',
        'basket' => 'required',
        'medical_fees' => 'required',
        'cod_surgical_act' => 'required'
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

                $historia = new log_unit_cost([
                    'cod_surgical_act' => $model->cod_surgical_act,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_unit_cost()->save($historia);
            }
        });
    }

    public function log_unit_cost()
    {
        return $this->hasMany(log_unit_cost::class, 'cod_surgical_act', 'cod_surgical_act');
    }
    
}
