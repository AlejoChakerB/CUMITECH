<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class log_diferential_rates
 * @package App\Models
 * @version August 12, 2024, 11:29 am -05
 *
 * @property integer $id_drate
 * @property json $old
 * @property json $new
 * @property string $observation
 * @property integer $user_id
 */
class log_diferential_rates extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_diferential_rates';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_drate',
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
        'id_drate' => 'integer',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_drate' => 'required',
        'old' => 'required',
        'new' => 'required',
        'observation' => 'required',
        'user_id' => 'required'
    ];

    
}
