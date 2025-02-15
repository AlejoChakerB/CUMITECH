<?php

namespace App\Repositories;

use App\Models\log_operation_cost;
use App\Repositories\BaseRepository;

/**
 * Class log_operation_costRepository
 * @package App\Repositories
 * @version February 2, 2024, 9:21 am -05
*/

class log_operation_costRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'percentage_uvr',
        'time_procedure',
        'doctor_percentage',
        'doctor_fees',
        'anest_percentage',
        'anest_fees',
        'total_uvr',
        'room_cost',
        'gases',
        'labour',
        'cod_surgical_act',
        'code_procedure'
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
        return log_operation_cost::class;
    }
}
