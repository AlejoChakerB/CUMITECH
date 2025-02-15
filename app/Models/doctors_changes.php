<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class doctors_changes
 * @package App\Models
 * @version April 2, 2024, 4:57 pm -05
 *
 * @property integer $code_doctor
 * @property json $old
 * @property json $new
 * @property integer $user_id
 */
class doctors_changes extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'doctors_changes';
    

    protected $dates = ['deleted_at'];


    public function doctors()
    {
        return $this->belongsTo(Doctors::class, 'code_doctor', 'code');
    }


    public $fillable = [
        'code_doctor',
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
        'code_doctor' => 'integer',
        'observation' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code_doctor' => 'required',
        'old' => 'required',
        'new' => 'required',
        'user_id' => 'required'
    ];

    
}
