<?php

namespace App\Repositories;

use App\Models\cumiLab_rate;
use App\Repositories\BaseRepository;

/**
 * Class cumiLab_rateRepository
 * @package App\Repositories
 * @version March 12, 2024, 4:24 pm -05
*/

class cumiLab_rateRepository extends BaseRepository
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
        'june',
        'july',
        'august',
        'october',
        'november',
        'december',
        'total_months',
        'average_months',
        'cumilab_rate',
        'mutual_rate',
        'pxq',
        'part_percentage',
        'adminlog_percentage',
        'cd_percentage',
        'total'
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
        return cumiLab_rate::class;
    }
}
