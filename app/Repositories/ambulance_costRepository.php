<?php

namespace App\Repositories;

use App\Models\ambulance_cost;
use App\Repositories\BaseRepository;

/**
 * Class ambulance_costRepository
 * @package App\Repositories
 * @version April 23, 2024, 3:40 pm -05
*/

class ambulance_costRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'CUPS',
        'name',
        'value',
        'recharge'
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
        return ambulance_cost::class;
    }
}
