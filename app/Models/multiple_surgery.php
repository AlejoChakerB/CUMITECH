<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class multiple_surgery
 * @package App\Models
 * @version January 25, 2024, 4:48 pm -05
 *
 * @property string $mdate_surgery
 * @property string $mstart_time
 * @property string $mend_time
 * @property integer $msurgery_time
 * @property string $moperating_room
 * @property integer $mcod_surgical_act
 * @property integer $mstudy_number
 * @property string $patient
 * @property integer $id_doctor
 * @property integer $id_doctor2
 * @property integer $id_anesth
 * @property integer $id_procedures
 * @property integer $cod_helper
 * @property integer $cod_instrumentator
 * @property integer $cod_rotator
 * @property string $category
 */
class multiple_surgery extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'multiple_surgeries';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'mdate_surgery',
        'mstart_time',
        'mend_time',
        'msurgery_time',
        'moperating_room',
        'mcod_surgical_act',
        'mstudy_number',
        'patient',
        'id_doctor',
        'id_doctor2',
        'id_anesth',
        'id_procedures',
        'cod_helper',
        'cod_instrumentator',
        'cod_rotator',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'mdate_surgery' => 'string',
        'mstart_time' => 'string',
        'mend_time' => 'string',
        'msurgery_time' => 'integer',
        'moperating_room' => 'string',
        'mcod_surgical_act' => 'integer',
        'mstudy_number' => 'integer',
        'patient' => 'string',
        'id_doctor' => 'integer',
        'id_doctor2' => 'integer',
        'id_anesth' => 'integer',
        'id_procedures' => 'integer',
        'cod_helper' => 'integer',
        'cod_instrumentator' => 'integer',
        'cod_rotator' => 'integer',
        'category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mdate_surgery' => 'required',
        'mstart_time' => 'required',
        'mend_time' => 'required',
        'moperating_room' => 'required',
        'mcod_surgical_act' => 'required',
        'mstudy_number' => 'required',
        'patient' => 'required',
        'id_doctor' => 'required',
        'id_procedures' => 'required',
        'category' => 'required'
    ];

    
}
