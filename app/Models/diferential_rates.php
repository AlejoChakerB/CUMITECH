<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\log_diferential_rates;

/**
 * Class diferential_rates
 * @package App\Models
 * @version December 1, 2023, 9:32 am -05
 *
 * @property number $value1
 * @property number $value2
 * @property varchar $observation_rates
 * @property integer $id_procedure
 * @property integer $id_doctor
 */
class diferential_rates extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'diferential_rates';
    
    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'id_procedure');
    }

    public function doctors()
    {
        return $this->belongsTo(Doctors::class, 'id_doctor', 'code');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'value1',
        'value2',
        'observation_rates',
        'id_procedure',
        'id_doctor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'value1' => 'decimal:2',
        'value2' => 'decimal:2',
        'observation_rates' => 'string',
        'id_procedure' => 'integer',
        'id_doctor' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'value1' => 'required',
        'id_procedure' => 'required',
        'id_doctor' => 'required'
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

                $historia = new log_diferential_rates([
                    'id_drate' => $model->id,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_diferential_rates()->save($historia);
            }
        });
    }

    public function log_diferential_rates()
    {
        return $this->hasMany(log_diferential_rates::class, 'id_drate', 'id');
    }
}
