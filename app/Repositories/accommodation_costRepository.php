<?php

namespace App\Repositories;

use App\Models\accommodation_cost;
use App\Repositories\BaseRepository;

/**
 * Class accommodation_costRepository
 * @package App\Repositories
 * @version April 9, 2024, 11:21 am -05
*/

class accommodation_costRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year',
        'month',
        'service',
        'bedrooms',
        'beds',
        'days_produced',
        'hours_produced',
        'minutes_produced',
        'permanent_overhead',
        'variable_overhead',
        'administrative_twoLevel',
        'logistic_twoLevel',
        'plant_labour',
        'labour',
        'total_cost',
        'daily_cost',
        'bedxday_cost',
        'hourAccommodation_cost',
        'bedxhour_cost',
        'bedxminute_cost'
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
        return accommodation_cost::class;
    }
}
