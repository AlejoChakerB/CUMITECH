<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\log_blood_bank;

/**
 * Class blood_bank_month
 * @package App\Models
 * @version April 22, 2024, 12:11 pm -05
 *
 * @property string $period
 * @property number $january
 * @property number $january_value
 * @property number $february
 * @property number $february_value
 * @property number $march
 * @property number $march_value
 * @property number $april
 * @property number $april_value
 * @property number $may
 * @property number $may_value
 * @property number $june
 * @property number $june_value
 * @property number $july
 * @property number $july_value
 * @property number $august
 * @property number $august_value
 * @property number $september
 * @property number $september_value
 * @property number $october
 * @property number $october_value
 * @property number $november
 * @property number $november_value
 * @property number $december
 * @property number $december_value
 * @property number $average_months
 * @property number $unit_price
 * @property string $cups
 */
class blood_bank_month extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'blood_bank_months';
    
    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'cups', 'code');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'period',
        'january',
        'january_value',
        'february',
        'february_value',
        'march',
        'march_value',
        'april',
        'april_value',
        'may',
        'may_value',
        'june',
        'june_value',
        'july',
        'july_value',
        'august',
        'august_value',
        'september',
        'september_value',
        'october',
        'october_value',
        'november',
        'november_value',
        'december',
        'december_value',
        'average_months',
        'unit_price',
        'total_months',
        'total_value',
        'average_value',
        'participe',
        'honorary_bs',
        'log',
        'admin',
        'total_cost',
        'cups',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'period' => 'string',
        'january' => 'integer',
        'january_value' => 'decimal:2',
        'february' => 'integer',
        'february_value' => 'decimal:2',
        'march' => 'integer',
        'march_value' => 'decimal:2',
        'april' => 'integer',
        'april_value' => 'decimal:2',
        'may' => 'integer',
        'may_value' => 'decimal:2',
        'june' => 'integer',
        'june_value' => 'decimal:2',
        'july' => 'integer',
        'july_value' => 'decimal:2',
        'august' => 'integer',
        'august_value' => 'decimal:2',
        'september' => 'integer',
        'september_value' => 'decimal:2',
        'october' => 'integer',
        'october_value' => 'decimal:2',
        'november' => 'integer',
        'november_value' => 'decimal:2',
        'december' => 'integer',
        'december_value' => 'decimal:2',
        'average_months' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_months'=> 'integer',
        'total_value' => 'decimal:2',
        'average_value'=> 'decimal:2',
        'participe' => 'decimal:2',
        'honorary_bs' => 'decimal:2',
        'log' => 'decimal:2',
        'admin' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'cups' => 'string',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'period' => 'required',
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

                $historia = new log_blood_bank([
                    'cups' => $model->cups,
                    'old' => json_encode($oldData),
                    'new' => json_encode($newData),
                    'observation' => $observation,
                    'user_id' => auth()->id(),
                ]);

                $model->log_blood_bank()->save($historia);
            }
        });
    }

    public function log_blood_bank()
    {
        return $this->hasMany(log_blood_bank::class, 'cups', 'cups');
    }
    
}
