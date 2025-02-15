<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class user_employees
 * @package App\Models
 * @version September 24, 2024, 8:56 am -05
 *
 * @property integer $id_user
 * @property integer $id_employees
 */
class user_employee extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_employees';
    
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employees');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function presenter()
    {
        return $this->hasMany(presenter::class);
    }
    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_user',
        'id_employees'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_user' => 'integer',
        'id_employees' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_user' => 'required',
        'id_employees' => 'required'
    ];

    
}
