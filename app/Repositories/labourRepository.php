<?php

namespace App\Repositories;

use App\Models\labour;
use App\Repositories\BaseRepository;

/**
 * Class labourRepository
 * @package App\Repositories
 * @version November 30, 2023, 2:38 pm -05
*/

class labourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'position',
        'salary',
        'labor_value'
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
        return labour::class;
    }
}
