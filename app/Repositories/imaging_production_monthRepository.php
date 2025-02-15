<?php

namespace App\Repositories;

use App\Models\imaging_production_month;
use App\Repositories\BaseRepository;

/**
 * Class imaging_production_monthRepository
 * @package App\Repositories
 * @version April 3, 2024, 10:05 am -05
*/

class imaging_production_monthRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'period',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'average_months',
        'duration',
        'total_duration',
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
        return imaging_production_month::class;
    }
}
