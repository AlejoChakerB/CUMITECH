<?php

namespace App\Repositories;

use App\Models\unit_costs;
use App\Repositories\BaseRepository;

/**
 * Class unit_costsRepository
 * @package App\Repositories
 * @version December 1, 2023, 10:56 am -05
*/

class unit_costsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room_cost',
        'gas',
        'total_value',
        'labour',
        'basket',
        'medical_fees',
        'consumables',
        'cod_surgical_act'
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
        return unit_costs::class;
    }
}
