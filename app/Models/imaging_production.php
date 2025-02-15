<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class imaging_production
 * @package App\Models
 * @version March 21, 2024, 10:16 am -05
 *
 * @property string $go_study
 * @property integer $id_order
 * @property string $modality
 * @property integer $dni_patient
 * @property string $name_patient
 * @property string $income
 * @property string $contract
 * @property string $date
 * @property string $hour
 * @property integer $cod_medi
 * @property integer $cups
 */
class imaging_production extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imaging_productions';
    

    protected $dates = ['deleted_at'];

    public function doctors()
    {
        return $this->belongsTo(doctors::class, 'cod_medi', 'code');
    }

    public function procedures()
    {
        return $this->belongsTo(procedures::class, 'cups', 'id');
    }

    public $fillable = [
        'go_study',
        'id_order',
        'modality',
        'dni_patient',
        'name_patient',
        'income',
        'contract',
        'date',
        'hour',
        'cod_medi',
        'cups'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'go_study' => 'string',
        'id_order' => 'integer',
        'modality' => 'string',
        'dni_patient' => 'integer',
        'name_patient' => 'string',
        'income' => 'string',
        'contract' => 'string',
        'date' => 'string',
        'hour' => 'string',
        'cod_medi' => 'integer',
        'cups' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_order' => 'required',
        'modality' => 'required',
        'dni_patient' => 'required',
        'name_patient' => 'required',
        'date' => 'required',
        'hour' => 'required',
        'cod_medi' => 'required',
        'cups' => 'required'
    ];

    
}
