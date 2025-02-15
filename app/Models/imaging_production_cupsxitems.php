<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class imaging_production_cupsxitems
 * @package App\Models
 * @version April 6, 2024, 9:20 am -05
 *
 * @property string $service
 * @property string $category
 * @property string $sub_category
 * @property json $cups
 * @property json $items
 */
class imaging_production_cupsxitems extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imaging_production_cupsxitems';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'service',
        'category',
        'sub_category',
        'cups',
        'items'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service' => 'string',
        'category' => 'string',
        'sub_category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service' => 'required',
        'category' => 'required',
        'sub_category' => 'required',
        'cups' => 'required'
    ];

    
}
