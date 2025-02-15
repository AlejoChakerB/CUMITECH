<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class medical_fees
 * @package App\Models
 * @version November 30, 2023, 3:46 pm -05
 *
 * @property integer $honorary_code
 * @property string $payment_manual
 */
class medical_fees extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'medical_fees';
    
    public function doctors()
    {
        return $this->hasMany(Doctors::class, 'honorary_code', 'id_fees');
    }

    public function doctors2()
    {
        return $this->hasMany(Doctors::class, 'honorary_code', 'id_fees2');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'honorary_code',
        'payment_manual'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'honorary_code' => 'integer',
        'payment_manual' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'honorary_code' => 'required',
        'payment_manual' => 'required'
    ];

    
}
