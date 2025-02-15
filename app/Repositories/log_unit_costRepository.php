<?php

namespace App\Repositories;

use App\Models\log_unit_cost;
use App\Repositories\BaseRepository;

/**
 * Class log_unit_costRepository
 * @package App\Repositories
 * @version August 13, 2024, 10:53 am -05
*/

class log_unit_costRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cod_surgical_act',
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
        return log_unit_cost::class;
    }
}
