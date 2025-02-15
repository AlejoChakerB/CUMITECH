<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class log_cext_details
 * @package App\Models
 * @version August 13, 2024, 2:08 pm -05
 *
 * @property integer $id_cextDetail
 * @property json $old
 * @property json $new
 * @property string $observation
 * @property integer $user_id
 */
class log_cext_details extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'log_cext_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_cextDetail',
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
        'id_cextDetail' => 'integer',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_cextDetail' => 'required',
        'old' => 'required',
        'new' => 'required',
        'observation' => 'required',
        'user_id' => 'required'
    ];

    
}
