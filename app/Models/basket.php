<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class basket
 * @package App\Models
 * @version November 30, 2023, 3:03 pm -05
 *
 * @property integer $store
 * @property integer $item_quantity
 * @property integer $reusable
 * @property string $id_article
 * @property integer $surgical_act
 */
class basket extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'baskets';
    
    public function articles()
    {
        return $this->belongsTo(Articles::class, 'id_article', 'item_code');
    }

    public function surgery()
    {
        return $this->belongsTo(Surgery::class, 'surgical_act');
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        'store',
        'item_quantity',
        'reusable',
        'article_cost',
        'id_article',
        'surgical_act'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'store' => 'string',
        'item_quantity' => 'integer',
        'reusable' => 'integer',
        'article_cost' => 'decimal:2',
        'id_article' => 'string',
        'surgical_act' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'store' => 'required',
        'item_quantity' => 'required',
        'reusable' => 'required',
        'article_cost' => 'required',
        'id_article' => 'required',
        'surgical_act' => 'required'
    ];

    
}
