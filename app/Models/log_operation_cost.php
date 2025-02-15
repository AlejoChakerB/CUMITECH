<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\log_details_unitCost;
/**
 * Class log_operation_cost
 * @package App\Models
 * @version February 2, 2024, 9:21 am -05
 *
 * @property integer $percentage_uvr
 * @property string $time_procedure
 * @property integer $doctor_percentage
 * @property number $doctor_fees
 * @property integer $doctor2_percentage
 * @property number $doctor2_fees
 * @property integer $anest_percentage
 * @property number $anest_fees
 * @property integer $total_uvr
 * @property number $room_cost
 * @property number $gases
 * @property number $labour
 * @property integer $cod_surgical_act
 * @property integer $code_procedure
 */
class log_operation_cost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_operation_costs';
    
    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'code_procedure');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'percentage_parti',
        'time_procedure',
        'doctor_percentage',
        'doctor_fees',
        'doctor2_percentage',
        'doctor2_fees',
        'anest_percentage',
        'anest_fees',
        'percentage_liquidated',
        'value_liquidated',
        'total_liquidated',
        'room_cost',
        'gases',
        'category',
        'mode',
        'id_fact',
        'cod_package',
        'dist_package',
        'cod_surgical_act',
        'code_procedure'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'percentage_parti' => 'decimal:2',
        'time_procedure' => 'string',
        'doctor_percentage' => 'integer',
        'doctor_fees' => 'decimal:2',
        'doctor2_percentage' => 'integer',
        'doctor2_fees' => 'decimal:2',
        'anest_percentage' => 'integer',
        'anest_fees' => 'decimal:2',
        'percentage_liquidated' => 'decimal:2',
        'value_liquidated' => 'decimal:2',
        'total_liquidated' => 'decimal:2',
        'room_cost' => 'decimal:2',
        'gases' => 'decimal:2',
        'category' => 'string',
        'mode' => 'string',
        'id_fact' => 'integer',
        'cod_package' => 'integer',
        'dist_package' => 'decimal:2',
        'cod_surgical_act' => 'integer',
        'code_procedure' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
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

                $historia = new log_details_unitCost([
                    'id_operation_cost' => $model->id,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_details_unitCost()->save($historia);
            }
        });
    }

    public function log_details_unitCost()
    {
        return $this->hasMany(log_details_unitCost::class, 'id_operation_cost', 'id');
    }
    
}
