<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class log_unit_cost
 * @package App\Models
 * @version August 13, 2024, 10:53 am -05
 *
 * @property integer $cod_surgical_act
 * @property json $old
 * @property json $new
 * @property string $observation
 * @property integer $user_id
 */
class log_unit_cost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_unit_costs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cod_surgical_act',
        'old',
        'new',
        'observation',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cod_surgical_act' => 'integer',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cod_surgical_act' => 'required',
        'old' => 'required',
        'new' => 'required',
        'observation' => 'required',
        'user_id' => 'required'
    ];

    
}
