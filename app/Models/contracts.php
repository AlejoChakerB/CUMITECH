<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class contracts
 * @package App\Models
 * @version June 5, 2023, 8:51 am -05
 *
 * @property decimal $salary
 * @property string $start_date_contract
 * @property string $disable
 * @property integer $employe_id
 */
class contracts extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contracts';
    
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    public function endowment()
    {
        return $this->hasMany(Endowment::class, 'contract_id');
    }


    protected $dates = ['deleted_at'];



    public $fillable = [
        'salary',
        'start_date_contract',
        'disable',
        'employe_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date_contract' => 'date',
        'disable' => 'string',
        'employe_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'salary' => 'required',
        'start_date_contract' => 'required',
        'employe_id' => 'required'
    ];

    
}
