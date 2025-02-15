<?php

namespace App\Repositories;

use App\Models\log_patology;
use App\Repositories\BaseRepository;

/**
 * Class log_patologyRepository
 * @package App\Repositories
 * @version August 13, 2024, 3:10 pm -05
*/

class log_patologyRepository extends BaseRepository
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
        return log_patology::class;
    }
}
