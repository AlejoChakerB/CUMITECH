<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class rented_equipment
 * @package App\Models
 * @version March 5, 2024, 4:54 pm -05
 *
 * @property string $art_code
 * @property string $description
 * @property number $value
 * @property string $specialty
 * @property string $procedure_id
 */
class rented_equipment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rented_equipments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'art_code',
        'description',
        'value',
        'specialty',
        'procedure_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'art_code' => 'string',
        'description' => 'string',
        'value' => 'decimal:2',
        'specialty' => 'string',
        'procedure_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'art_code' => 'required',
        'description' => 'required',
        'value' => 'required',
        'procedure_id' => 'required'
    ];

    
}
