<?php

namespace App\Repositories;

use App\Models\imaging_production_details;
use App\Repositories\BaseRepository;

/**
 * Class imaging_production_detailsRepository
 * @package App\Repositories
 * @version April 3, 2024, 12:03 pm -05
*/

class imaging_production_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'service',
        'duration',
        'room_cost',
        'transcriber_cost',
        'doctor_cost',
        'supplies_cost',
        'total_cost',
        'cups'
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
        return imaging_production_details::class;
    }
}
