<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\doctors_changes;

/**
 * Class doctors
 * @package App\Models
 * @version December 1, 2023, 9:52 am -05
 *
 * @property integer $code
 * @property integer $dni
 * @property string $full_name
 * @property string $specialty
 * @property integer $id_rates
 * @property integer $id_fees
 * @property string $payment
 */
class doctors extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'doctors';

    public function surgeries()
    {
        return $this->hasMany(Surgery::class,'code', 'id_doctor');
    }

    public function diferential_rates()
    {
        return $this->hasMany(Diferential_rates::class, 'code', 'id_doctor');
    }

    public function medical_fees()
    {
        return $this->belongsTo(Medical_fees::class, 'id_fees', 'honorary_code');
    }

    public function medical_fees2()
    {
        return $this->belongsTo(Medical_fees::class, 'id_fees2', 'honorary_code');
    }

    public function imaging_production()
    {
        return $this->hasMany(Imaging_production::class,'code', 'cod_medi');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'dni',
        'full_name',
        'category_doctor',
        'specialty',
        'payment_type',
        'payment',
        'id_fees',
        'id_fees2'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'integer',
        'dni' => 'integer',
        'full_name' => 'string',
        'category_doctor' => 'string',
        'specialty' => 'string',
        'payment_type' => 'string',
        'payment' => 'string',
        'id_fees' => 'integer',
        'id_fees2' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'dni' => 'required',
        'full_name' => 'required',
        'category_doctor' => 'required',
        'specialty' => 'required',
        'payment_type' => 'required',
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

                $historia = new Doctors_changes([
                    'code_doctor' => $model->code,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->doctors_changes()->save($historia);
            }
        });
    }

    public function doctors_changes()
    {
        return $this->hasMany(Doctors_changes::class, 'code_doctor', 'code');
    }

    
}
