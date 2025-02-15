<?php

namespace App\Repositories;

use App\Models\log_accommodation_cost;
use App\Repositories\BaseRepository;

/**
 * Class log_accommodation_costRepository
 * @package App\Repositories
 * @version August 13, 2024, 2:36 pm -05
*/

class log_accommodation_costRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
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
        return log_accommodation_cost::class;
    }
}
