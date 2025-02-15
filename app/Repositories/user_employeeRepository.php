<?php

namespace App\Repositories;

use App\Models\user_employee;
use App\Repositories\BaseRepository;

/**
 * Class user_employeeRepository
 * @package App\Repositories
 * @version September 24, 2024, 8:56 am -05
*/

class user_employeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_user',
        'id_employees'
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
        return user_employee::class;
    }
}
