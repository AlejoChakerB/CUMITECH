<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class msurgery_procedure
 * @package App\Models
 * @version January 25, 2024, 4:56 pm -05
 *
 * @property integer $amount
 * @property string $type
 * @property integer $mcod_surgical_act
 * @property integer $code_procedure
 * @property string $observation
 */
class msurgery_procedure extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'msurgery_procedures';

    public function procedures()
    {
        return $this->belongsTo(Procedures::class, 'code_procedure');
    }

    public function surgery()
    {
        return $this->belongsTo(Surgery::class, 'cod_surgical_act', 'cod_surgical_act');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'amount',
        'type',
        'cod_surgical_act',
        'code_procedure',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'integer',
        'type' => 'string',
        'cod_surgical_act' => 'integer',
        'code_procedure' => 'integer',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required',
        'type' => 'required',
        'cod_surgical_act' => 'required',
        'code_procedure' => 'required'
    ];

    
}
