<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class stand_assistance
 * @package App\Models
 * @version September 24, 2024, 9:53 am -05
 *
 * @property string $stand
 * @property string $state
 * @property string $approved_date
 * @property integer $id_user_employees
 * @property integer $id_presenter
 */
class stand_assistance extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stand_assistances';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'stand',
        'state',
        'approved_date',
        'id_user_employees',
        'id_presenter'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'stand' => 'string',
        'state' => 'string',
        'approved_date' => 'string',
        'id_user_employees' => 'integer',
        'id_presenter' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
