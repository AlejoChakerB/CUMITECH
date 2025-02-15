<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class card
 * @package App\Models
 * @version June 14, 2023, 2:11 pm -05
 *
 * @property string $delivery_date_card
 * @property string $signature_employe_card
 * @property string $card_item
 * @property integer $employe_id
 */
class card extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cards';
    

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }
    
    protected $dates = ['deleted_at'];



    public $fillable = [
        'delivery_date_card',
        'signature_employe_card',
        'card_item',
        'employe_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'delivery_date_card' => 'date',
        'signature_employe_card' => 'string',
        'card_item' => 'string',
        'employe_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'delivery_date_card' => 'required',
        'employe_signature' => 'required',
        'employe_id' => 'required'
    ];

    
}
