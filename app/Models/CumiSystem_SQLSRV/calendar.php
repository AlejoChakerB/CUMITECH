<?php

namespace App\Models\CumiSystem_SQLSRV;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class calendar extends CumiSystemModel
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'calendars';

    protected $dates = ['deleted_at'];

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    public $fillable = [
        'start_date',
        'end_date',
        'entry_time',
        'departure_time',
        'floor',
        'employe_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'entry_time' => 'string',
        'departure_time' => 'string',
        'floor' => 'string',
        'employe_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'start_date' => 'required',
        'end_date' => 'required',
        'entry_time' => 'required',
        'departure_time' => 'required',
        'floor' => 'required',
        'employe_id' => 'required'
    ];

}