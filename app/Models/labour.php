<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class labour
 * @package App\Models
 * @version November 30, 2023, 2:38 pm -05
 *
 * @property string $position
 * @property number $salary
 * @property number $labor_value
 */
class labour extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'labours';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'position',
        'salary',
        'labor_value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'string',
        'salary' => 'decimal:2',
        'labor_value' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'position' => 'required',
        'salary' => 'required',
        'labor_value' => 'required'
    ];

    
}
