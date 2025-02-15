<?php

namespace App\Models\CumiSystem_SQLSRV;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class presenter
 * @package App\Models
 * @version September 24, 2024, 9:25 am -05
 *
 * @property string $stand
 * @property integer $id_users_employees
 */
class presenter extends CumiSystemModel
{
    use SoftDeletes;

    use HasFactory;

    public function user_employees()
    {
        return $this->belongsTo(User_employee::class, 'id_users_employees');
    }

    public $table = 'presenters';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'stand',
        'qr_code',
        'id_users_employees'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'stand' => 'string',
        'qr_code' => 'string',
        'id_users_employees' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'stand' => 'required',
        'id_users_employees' => 'required'
    ];

    
}
