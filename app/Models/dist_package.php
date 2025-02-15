<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class dist_package
 * @package App\Models
 * @version May 20, 2024, 11:59 am -05
 *
 * @property string $description
 * @property number $value
 * @property integer $cod_package
 * @property string $study
 * @property string $cod_procedure
 */
class dist_package extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'dist_packages';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'description',
        'value',
        'cod_package',
        'id_factu',
        'study',
        'cod_surgical_act'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'string',
        'value' => 'decimal:2',
        'cod_package' => 'string',
        'id_factu' => 'integer',
        'study' => 'string',
        'cod_surgical_act' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',
        'value' => 'required',
        'cod_package' => 'required',
        'study' => 'required',
        'cod_surgical_act' => 'required'
    ];

    
}
