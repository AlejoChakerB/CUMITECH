<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class log_details_unitCost
 * @package App\Models
 * @version August 13, 2024, 11:28 am -05
 *
 * @property integer $id_operation_cost
 * @property json $old
 * @property json $new
 * @property string $observation
 * @property integer $user_id
 */
class log_details_unitCost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_details_unit_costs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_operation_cost',
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
        'id_operation_cost' => 'integer',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_operation_cost' => 'required',
        'old' => 'required',
        'new' => 'required',
        'observation' => 'required',
        'user_id' => 'required'
    ];

    
}
