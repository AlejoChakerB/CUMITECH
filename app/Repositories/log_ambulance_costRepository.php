<?php

namespace App\Repositories;

use App\Models\log_ambulance_cost;
use App\Repositories\BaseRepository;

/**
 * Class log_ambulance_costRepository
 * @package App\Repositories
 * @version August 13, 2024, 3:57 pm -05
*/

class log_ambulance_costRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cups',
        'old',
        'new',
        'observation',
        'user_id'
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
        return log_ambulance_cost::class;
    }
}
