<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class soat_group
 * @package App\Models
 * @version January 23, 2024, 10:33 am -05
 *
 * @property integer $group
 * @property number $surgeon
 * @property number $anesthed
 * @property number $assistant
 * @property number $room
 * @property number $materials
 * @property number $total
 */
class soat_group extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'soat_groups';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'group',
        'surgeon',
        'anesthed',
        'assistant',
        'room',
        'materials',
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'group' => 'integer',
        'surgeon' => 'decimal:2',
        'anesthed' => 'decimal:2',
        'assistant' => 'decimal:2',
        'room' => 'decimal:2',
        'materials' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'group' => 'required',
        'surgeon' => 'required'
    ];

    
}
