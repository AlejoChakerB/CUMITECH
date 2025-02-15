<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class endowment
 * @package App\Models
 * @version June 5, 2023, 12:01 pm -05
 *
 * @property json $item
 * @property string $deliver_date
 * @property string $employe_signature
 * @property string $period
 * @property integer $contract_id
 */
class endowment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'endowments';
    
    public function contracts(): BelongsTo
    {
        return $this->belongsTo(contracts::class, 'contract_id');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'item',
        'deliver_date',
        'employe_signature',
        'period',
        'contract_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'item' => 'json',
        'deliver_date' => 'date',
        'employe_signature' => 'string',
        'period' => 'string',
        'contract_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item' => 'required',
        'deliver_date' => 'required',
        'employe_signature' => 'required',
        'period' => 'required',
        'contract_id' => 'required'
    ];
}
