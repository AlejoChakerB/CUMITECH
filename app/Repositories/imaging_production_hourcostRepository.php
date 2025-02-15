<?php

namespace App\Repositories;

use App\Models\imaging_production_hourcost;
use App\Repositories\BaseRepository;

/**
 * Class imaging_production_hourcostRepository
 * @package App\Repositories
 * @version April 4, 2024, 12:02 pm -05
*/

class imaging_production_hourcostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'service',
        'permanent_overhead',
        'variable_overhead',
        'administrative_twoLevel',
        'logistic_twoLevel',
        'plant_labour',
        'labour',
        'total_cost',
        'employee',
        'hour_value',
        'number_rooms',
        'hour_value_room'
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
        return imaging_production_hourcost::class;
    }
}
