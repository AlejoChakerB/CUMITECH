<?php

namespace App\Repositories;

use App\Models\blood_bank_month;
use App\Repositories\BaseRepository;

/**
 * Class blood_bank_monthRepository
 * @package App\Repositories
 * @version April 22, 2024, 12:11 pm -05
*/

class blood_bank_monthRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'period',
        'january',
        'january_value',
        'february',
        'february_value',
        'march',
        'march_value',
        'april',
        'april_value',
        'may',
        'may_value',
        'june',
        'june_value',
        'july',
        'july_value',
        'august',
        'august_value',
        'september',
        'september_value',
        'october',
        'october_value',
        'november',
        'november_value',
        'december',
        'december_value',
        'average_months',
        'unit_price',
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
        return blood_bank_month::class;
    }
}
