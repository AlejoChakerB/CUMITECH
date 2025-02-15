<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class imaging_production_supplies
 * @package App\Models
 * @version April 4, 2024, 2:50 pm -05
 *
 * @property string $service
 * @property number $amount_week
 * @property number $unit_price
 * @property integer $id_article
 */
class imaging_production_supplies extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imaging_production_supplies';
    
    public function articles()
    {
        return $this->belongsTo(Articles::class, 'id_article');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'service',
        'amount_week',
        'quantity_used',
        'unit_price',
        'id_article'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service' => 'string',
        'amount_week' => 'decimal:2',
        'quantity_used' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'id_article' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service' => 'required',
        'amount_week' => 'required',
        'id_article' => 'required'
    ];

    
}
