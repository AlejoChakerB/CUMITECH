<?php

namespace App\Repositories;

use App\Models\cext_hourcost;
use App\Repositories\BaseRepository;

/**
 * Class cext_hourcostRepository
 * @package App\Repositories
 * @version April 12, 2024, 8:54 am -05
*/

class cext_hourcostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'permanent_overhead',
        'variable_overhead',
        'administrative_twoLevel',
        'logistic_twoLevel',
        'plant_labour',
        'labour',
        'total_cost',
        'days_produced',
        'hours_producedxday',
        'hours_producedxmonth',
        'room_valueTotal',
        'room_value'
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
        return cext_hourcost::class;
    }
}
