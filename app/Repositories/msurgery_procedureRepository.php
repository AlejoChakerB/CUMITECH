<?php

namespace App\Repositories;

use App\Models\msurgery_procedure;
use App\Repositories\BaseRepository;

/**
 * Class msurgery_procedureRepository
 * @package App\Repositories
 * @version January 25, 2024, 4:56 pm -05
*/

class msurgery_procedureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'type',
        'mcod_surgical_act',
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
        return msurgery_procedure::class;
    }
}
