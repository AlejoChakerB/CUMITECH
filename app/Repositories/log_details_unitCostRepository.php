<?php

namespace App\Repositories;

use App\Models\log_details_unitCost;
use App\Repositories\BaseRepository;

/**
 * Class log_details_unitCostRepository
 * @package App\Repositories
 * @version August 13, 2024, 11:28 am -05
*/

class log_details_unitCostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_operation_cost',
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
        return log_details_unitCost::class;
    }
}
