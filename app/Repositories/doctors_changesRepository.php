<?php

namespace App\Repositories;

use App\Models\doctors_changes;
use App\Repositories\BaseRepository;

/**
 * Class doctors_changesRepository
 * @package App\Repositories
 * @version April 2, 2024, 4:57 pm -05
*/

class doctors_changesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code_doctor',
        'old',
        'new',
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
        return doctors_changes::class;
    }
}
