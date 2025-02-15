<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class log_cumi_lab_rate
 * @package App\Models
 * @version August 13, 2024, 2:53 pm -05
 *
 * @property string $cups
 * @property json $old
 * @property json $new
 * @property string $observation
 * @property integer $user_id
 */
class log_cumi_lab_rate extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_cumi_lab_rates';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cups',
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
        'cups' => 'string',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cups' => 'required',
        'old' => 'required',
        'new' => 'required',
        'observation' => 'required',
        'user_id' => 'required'
    ];

    
}
