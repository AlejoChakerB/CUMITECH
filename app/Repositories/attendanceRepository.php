<?php

namespace App\Repositories;

use App\Models\CumiSystem_SQLSRV\attendance;
use App\Repositories\BaseRepository;

/**
 * Class attendanceRepository
 * @package App\Repositories
 * @version March 16, 2023, 11:56 am -05
*/

class attendanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'workday',
        'aentry_time',
        'adeparture_time',
        'minutes',
        'employe_id'
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
        return attendance::class;
    }
}
