<?php

namespace App\Repositories;

use App\Models\employe;
use App\Repositories\BaseRepository;

/**
 * Class employeRepository
 * @package App\Repositories
 * @version March 15, 2023, 8:02 pm UTC
*/

class employeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dni',
        'name',
        'work_position'
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
        return employe::class;
    }
}
