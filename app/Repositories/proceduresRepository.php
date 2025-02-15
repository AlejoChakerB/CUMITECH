<?php

namespace App\Repositories;

use App\Models\procedures;
use App\Repositories\BaseRepository;

/**
 * Class proceduresRepository
 * @package App\Repositories
 * @version November 30, 2023, 2:48 pm -05
*/

class proceduresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'manual_type',
        'description',
        'cups',
        'uvr',
        'procedure_value'
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
        return procedures::class;
    }
}
