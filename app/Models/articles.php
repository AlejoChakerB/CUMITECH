<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class articles
 * @package App\Models
 * @version November 30, 2023, 2:32 pm -05
 *
 * @property string $type
 * @property integer $item_code
 * @property string $description
 * @property number $average_cost
 * @property number $last_cost
 * @property integer $usage_quantity
 */
class articles extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'articles';
    
    public function consumable()
    {
        return $this->hasMany(Consumable::class, 'item_code', 'id_article');
    }

    public function basket()
    {
        return $this->hasMany(Basket::class, 'item_code', 'id_article');
    }

    public function imaging_production_supplies()
    {
        return $this->hasMany(Imaging_production_supplies::class, 'id_article');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'item_code',
        'description',
        'average_cost',
        'last_cost',
        'usage_quantity',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'item_code' => 'string',
        'description' => 'string',
        'average_cost' => 'decimal:2',
        'last_cost' => 'decimal:2',
        'usage_quantity' => 'integer',
        'observation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'item_code' => 'required',
        'description' => 'required',
        'average_cost' => 'required',
        'last_cost' => 'required'
    ];

    
}
