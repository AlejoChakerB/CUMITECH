<?php

namespace App\Models\CumiSystem_SQLSRV;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class attendance extends CumiSystemModel
{
    protected $table = 'attendances';

    public function employe()
    {
        return $this->belongsTo(employe::class, 'employe_id');
    }


    public $fillable = [
        'workday',
        'aentry_time',
        'adeparture_time',
        'employe_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'workday' => 'date',
        'aentry_time' => 'string',
        'adeparture_time' => 'string',
        'employe_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'workday' => 'required',
        'aentry_time' => 'required',
        'employe_id' => 'required'
    ];
}