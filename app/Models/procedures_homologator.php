<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class procedures_homologator
 * @package App\Models
 * @version June 20, 2024, 4:36 pm -05
 *
 * @property string $cups
 * @property string $cups_soat
 * @property string $description_soat
 * @property string $cups_iss
 * @property string $description_iss
 * @property string $service_reps
 * @property string $category
 * @property string $group
 * @property string $subgroup
 * @property integer $uvr
 * @property number $honorary_iss
 * @property number $anest_iss
 * @property number $helper_iss
 * @property number $room_iss
 * @property number $materials_iss
 * @property number $value_iss
 * @property integer $uvt
 * @property number $honorary_soat
 * @property number $anest_soat
 * @property number $helper_soat
 * @property number $room_soat
 * @property number $materials_soat
 * @property number $value_soat
 * @property string $observation
 */
class procedures_homologator extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'procedures_homologators';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cups',
        'cups_soat',
        'description_soat',
        'cups_iss',
        'description_iss',
        'service_reps',
        'category',
        'group',
        'subgroup',
        'uvr',
        'honorary_iss',
        'anest_iss',
        'helper_iss',
        'room_iss',
        'materials_iss',
        'value_iss',
        'uvt',
        'honorary_soat',
        'anest_soat',
        'helper_soat',
        'room_soat',
        'materials_soat',
        'value_soat',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cups' => 'string',
        'cups_soat' => 'string',
        'description_soat' => 'string',
        'cups_iss' => 'string',
        'description_iss' => 'string',
        'service_reps' => 'string',
        'category' => 'string',
        'group' => 'string',
        'subgroup' => 'string',
        'uvr' => 'integer',
        'honorary_iss' => 'decimal:2',
        'anest_iss' => 'decimal:2',
        'helper_iss' => 'decimal:2',
        'room_iss' => 'decimal:2',
        'materials_iss' => 'decimal:2',
        'value_iss' => 'decimal:2',
        'uvt' => 'integer',
        'honorary_soat' => 'decimal:2',
        'anest_soat' => 'decimal:2',
        'helper_soat' => 'decimal:2',
        'room_soat' => 'decimal:2',
        'materials_soat' => 'decimal:2',
        'value_soat' => 'decimal:2',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cups' => 'required'
    ];

    
}
