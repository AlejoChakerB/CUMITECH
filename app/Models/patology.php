<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\log_patology;

/**
 * Class patology
 * @package App\Models
 * @version April 23, 2024, 4:19 pm -05
 *
 * @property string $service
 * @property string $cups
 * @property string $description
 * @property number $value
 * @property string $observation
 */
class patology extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'patologies';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'service',
        'cups',
        'description',
        'value',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service' => 'string',
        'cups' => 'string',
        'description' => 'string',
        'value' => 'decimal:2',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service' => 'required',
        'cups' => 'required',
        'description' => 'required',
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

                $historia = new log_patology([
                    'cups' => $model->cups,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_patology()->save($historia);
            }
        });
    }

    public function log_patology()
    {
        return $this->hasMany(log_patology::class, 'cups', 'cups');
    }
}
