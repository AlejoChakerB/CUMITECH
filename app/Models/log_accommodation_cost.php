<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class log_accommodation_cost
 * @package App\Models
 * @version August 13, 2024, 2:36 pm -05
 *
 * @property integer $id
 * @property json $old
 * @property json $new
 * @property string $observation
 * @property integer $user_id
 */
class log_accommodation_cost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_accommodation_costs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_accommodation',
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
        'id_accommodation' => 'integer',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_accommodation' => 'required',
        'old' => 'required',
        'new' => 'required',
        'observation' => 'required',
        'user_id' => 'required'
    ];

    
}
