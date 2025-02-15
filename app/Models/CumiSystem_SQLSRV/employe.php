<?php

namespace App\Models\CumiSystem_SQLSRV;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employe extends CumiSystemModel
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'employes';

    public function attendances()
    {
        return $this->hasMany(attendance::class, 'employe_id');
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'dni',
        'name',
        'work_position',
        'unit',
        'cost_center',
        'service'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'integer',
        'name' => 'string',
        'work_position' => 'string',
        'unit' => 'string',
        'cost_center' => 'string',
        'service' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required',
        'name' => 'required',
        'work_position' => 'required',
        'unit' => 'required',
        'cost_center' => 'required',
        'service' => 'required'
    ];
}