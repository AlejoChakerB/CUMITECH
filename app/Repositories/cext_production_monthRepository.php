<?php

namespace App\Repositories;

use App\Models\cext_production_month;
use App\Repositories\BaseRepository;

/**
 * Class cext_production_monthRepository
 * @package App\Repositories
 * @version April 12, 2024, 9:27 am -05
*/

class cext_production_monthRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'specialty',
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
        'average_months',
        'duration',
        'total_duration'
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
        return cext_production_month::class;
    }
}
