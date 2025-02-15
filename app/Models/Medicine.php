<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Medicine
 * @package App\Models
 * @version June 21, 2023, 9:04 am -05
 *
 * @property string $admission_date
 * @property integer $act_number
 * @property string $generic_name
 * @property string $tradename
 * @property string $concentration
 * @property string $pharmaceutical_form
 * @property string $presentation
 * @property string $expiration_date
 * @property string $lot_number
 * @property string $invima_registrations_id
 * @property string $registration_validity
 * @property string $manufacturer_laboratory
 * @property string $supplier
 * @property string $invoice_number
 * @property integer $received_amount
 * @property string $purchase_order
 * @property string $entered_by
 * @property integer $sample
 * @property string $lettering
 * @property string $packing
 * @property string $laminate
 * @property string $closing
 * @property string $all
 * @property string $liquids
 * @property string $semisolid
 * @property string $dust
 * @property string $tablet
 * @property string $capsule
 * @property string $arrival_temperature
 * @property string $observations
 * @property string $state
 */
class Medicine extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'medicines';

    public function invima_registration()
    {
        return $this->belongsTo(Invima_registration::class, 'invima_registrations_id');
    }
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'admission_date',
        'act_number',
        'generic_name',
        'tradename',
        'concentration',
        'pharmaceutical_form',
        'presentation',
        'expiration_date',
        'lot_number',
        'invima_registrations_id',
        'registration_validity',
        'manufacturer_laboratory',
        'supplier',
        'invoice_number',
        'received_amount',
        'purchase_order',
        'entered_by',
        'sample',
        'lettering',
        'packing',
        'laminate',
        'closing',
        'all',
        'liquids',
        'semisolid',
        'dust',
        'tablet',
        'capsule',
        'arrival_temperature',
        'observations',
        'state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'admission_date' => 'date',
        'act_number' => 'integer',
        'generic_name' => 'string',
        'tradename' => 'string',
        'concentration' => 'string',
        'pharmaceutical_form' => 'string',
        'presentation' => 'string',
        'expiration_date' => 'date',
        'lot_number' => 'string',
        'invima_registrations_id' => 'integer',
        'registration_validity' => 'date',
        'manufacturer_laboratory' => 'string',
        'supplier' => 'string',
        'invoice_number' => 'string',
        'received_amount' => 'integer',
        'purchase_order' => 'string',
        'entered_by' => 'string',
        'sample' => 'integer',
        'lettering' => 'string',
        'packing' => 'string',
        'laminate' => 'string',
        'closing' => 'string',
        'all' => 'string',
        'liquids' => 'string',
        'semisolid' => 'string',
        'dust' => 'string',
        'tablet' => 'string',
        'capsule' => 'string',
        'arrival_temperature' => 'string',
        'observations' => 'string',
        'state' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'admission_date' => 'required',
        'act_number' => 'required',
        'generic_name' => 'required',
        'concentration' => 'required',
        'pharmaceutical_form' => 'required',
        'presentation' => 'required',
        'expiration_date' => 'required',
        'lot_number' => 'required',
        'invima_registrations_id' => 'required',
        'registration_validity' => 'required',
        'manufacturer_laboratory' => 'required',
        'supplier' => 'required',
        'invoice_number' => 'required',
        'received_amount' => 'required',
        'purchase_order' => 'required',
        'entered_by' => 'required',
        'sample' => 'required',
        'state' => 'required'
    ];

    
}
