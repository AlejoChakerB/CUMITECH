<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class calendar
 * @package App\Models
 * @version March 15, 2023, 8:51 pm UTC
 *
 * @property date $start_date
 * @property date $end_date
 * @property string $entry_time
 * @property string $departure_time
 * @property string $floor
 * @property integer $employe_id
 */
class calendar extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'calendars';
    
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    protected $dates = ['deleted_at'];



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
