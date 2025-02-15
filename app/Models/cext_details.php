<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\log_cext_details;

/**
 * Class cext_details
 * @package App\Models
 * @version April 11, 2024, 3:07 pm -05
 *
 * @property string $specialty
 * @property string $procedure
 * @property integer $duration
 * @property number $room_cost
 * @property number $medical_fees
 * @property number $supplies_cost
 * @property number $total_cost
 */
class cext_details extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cext_details';
    
    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'procedure', 'code');
    }


    protected $dates = ['deleted_at'];



    public $fillable = [
        'specialty',
        'procedure',
        'duration',
        'room_cost',
        'medical_fees',
        'supplies_cost',
        'total_cost'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'specialty' => 'string',
        'procedure' => 'string',
        'duration' => 'integer',
        'room_cost' => 'decimal:2',
        'medical_fees' => 'decimal:2',
        'supplies_cost' => 'decimal:2',
        'total_cost' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'specialty' => 'required',
        'procedure' => 'required',
        'duration' => 'required'
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

                $historia = new log_cext_details([
                    'id_cextDetail' => $model->cod_surgical_act,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_cext_details()->save($historia);
            }
        });
    }

    public function log_cext_details()
    {
        return $this->hasMany(log_cext_details::class, 'id_cextDetail', 'id');
    }
}
