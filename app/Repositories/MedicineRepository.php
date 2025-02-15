<?php

namespace App\Repositories;

use App\Models\Medicine;
use App\Repositories\BaseRepository;

/**
 * Class MedicineRepository
 * @package App\Repositories
 * @version June 21, 2023, 9:04 am -05
*/

class MedicineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'observation_record',
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Medicine::class;
    }
}
