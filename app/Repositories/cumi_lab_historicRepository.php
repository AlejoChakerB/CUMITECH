<?php

namespace App\Repositories;

use App\Models\cumi_lab_historic;
use App\Repositories\BaseRepository;

/**
 * Class cumi_lab_historicRepository
 * @package App\Repositories
 * @version April 2, 2024, 10:46 am -05
*/

class cumi_lab_historicRepository extends BaseRepository
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
        'total_months',
        'average_months',
        'cumilab_rate',
        'mutual_rate',
        'pxq',
        'part_percentage',
        'adminlog',
        'adminlog_percentage',
        'cd',
        'cd_percentage',
        'total',
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
        return cumi_lab_historic::class;
    }
}
