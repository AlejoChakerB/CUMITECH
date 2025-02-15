<?php

namespace App\Repositories;

use App\Models\presenter;
use App\Repositories\BaseRepository;

/**
 * Class presenterRepository
 * @package App\Repositories
 * @version September 24, 2024, 9:25 am -05
*/

class presenterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stand',
        'id_users_employees'
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
        return presenter::class;
    }
}
