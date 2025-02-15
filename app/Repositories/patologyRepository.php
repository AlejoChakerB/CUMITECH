<?php

namespace App\Repositories;

use App\Models\patology;
use App\Repositories\BaseRepository;

/**
 * Class patologyRepository
 * @package App\Repositories
 * @version April 23, 2024, 4:19 pm -05
*/

class patologyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'service',
        'cups',
        'description',
        'value',
        'observation'
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
        return patology::class;
    }
}
