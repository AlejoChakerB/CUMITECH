<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class surgery
 * @package App\Models
 * @version December 1, 2023, 10:26 am -05
 *
 * @property string $date_surgery
 * @property time $start_time
 * @property time $end_time
 * @property integer surgeryTime
 * @property string $operating_room
 * @property integer $cod_surgical_act
 * @property integer $study_number
 * @property string $patient
 * @property integer $id_doctor
 * @property integer $id_doctor2
 * @property integer $id_anesthesiologist
 * @property integer $cod_helper
 * @property integer $cod_instrumentator
 * @property integer $cod_rotator
 * @property integer $code_contract
 * @property integer $name_contract
 */
class surgery extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'surgeries';

    public function doctors()
    {
        return $this->belongsTo(Doctors::class, 'id_doctor', 'code');
    }

    public function basket()
    {
        return $this->hasMany(Basket::class, 'surgical_act');
    }

    public function unit_costs()
    {
        return $this->hasMany(Unit_costs::class, 'cod_surgical_act');
    }

    public function msurgery_procedure()
    {
        return $this->hasMany(Msurgery_procedure::class, 'cod_surgical_act', 'cod_surgical_act');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'date_surgery',
        'start_time',
        'end_time',
        'surgeryTime',
        'operating_room',
        'cod_surgical_act',
        'study_number',
        'patient',
        'labours',
        'id_doctor',
        'id_doctor2',
        'id_anesthesiologist',
        'cod_helper',
        'cod_instrumentator',
        'cod_rotator',
        'category',
        'code_contract',
        'name_contract'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_surgery' => 'string',
        'start_time' => 'string',
        'end_time' => 'string',
        'surgeryTime' => 'integer',
        'operating_room' => 'string',
        'cod_surgical_act' => 'integer',
        'study_number' => 'integer',
        'patient' => 'string',
        'id_doctor' => 'integer',
        'id_doctor2' => 'integer',
        'id_anesthesiologist' => 'integer',
        'cod_helper' => 'integer',
        'cod_instrumentator' => 'integer',
        'cod_rotator' => 'integer',
        'category' => 'string',
        'code_contract' => 'integer',
        'name_contract' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date_surgery' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'operating_room' => 'required',
        'cod_surgical_act' => 'required',
        'study_number' => 'required',
        'patient' => 'required',
        'id_doctor' => 'required',
        
    ];

    
}
