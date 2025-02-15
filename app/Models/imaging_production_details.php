<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\log_imaging_production_detail;

/**
 * Class imaging_production_details
 * @package App\Models
 * @version April 3, 2024, 12:03 pm -05
 *
 * @property string $service
 * @property integer $duration
 * @property number $room_cost
 * @property number $transcriber_cost
 * @property number $doctor_cost
 * @property number $supplies_cost
 * @property number $total_cost
 * @property integer $cups
 */
class imaging_production_details extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imaging_production_details';

    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'cups', 'code');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'service',
        'category',
        'duration',
        'room_cost',
        'transcriber_cost',
        'doctor_cost',
        'supplies_cost',
        'contrast',
        'sedation',
        'total_cost',
        'cups'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service' => 'string',
        'category' => 'string',
        'duration' => 'integer',
        'room_cost' => 'decimal:2',
        'transcriber_cost' => 'decimal:2',
        'doctor_cost' => 'decimal:2',
        'supplies_cost' => 'decimal:2',
        'contrast' => 'decimal:2',
        'sedation' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'cups' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service' => 'required',
        'category' => 'required',
        'duration' => 'required',
        'cups' => 'required'
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

                $historia = new log_imaging_production_detail([
                    'cups' => $model->cod_surgical_act,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_imaging_production_detail()->save($historia);
            }
        });
    }

    public function log_imaging_production_detail()
    {
        return $this->hasMany(log_imaging_production_detail::class, 'cups', 'cups');
    }
}
