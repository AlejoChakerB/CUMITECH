<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class detail_packages_temp
 * @package App\Models
 * @version June 11, 2024, 12:08 pm -05
 *
 * @property string $description
 * @property integer $cod_uf
 * @property string $funcional_unit
 * @property string $code_service
 * @property string $description_service
 * @property integer $id_factu
 * @property integer $quanty
 * @property number $recorded_cost
 * @property number $unit_cost
 * @property string $observation
 */
class detail_packages_temp extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'detail_packages_temps';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'description',
        'cod_uf',
        'funcional_unit',
        'code_service',
        'description_service',
        'id_factu',
        'study',
        'quanty',
        'recorded_cost',
        'unit_cost',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'string',
        'cod_uf' => 'integer',
        'funcional_unit' => 'string',
        'code_service' => 'string',
        'description_service' => 'string',
        'id_factu' => 'integer',
        'study' => 'integer',
        'quanty' => 'integer',
        'recorded_cost' => 'decimal:2',
        'unit_cost' => 'decimal:2',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
