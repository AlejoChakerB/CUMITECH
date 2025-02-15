<?php

namespace App\Repositories;

use App\Models\log_blood_bank;
use App\Repositories\BaseRepository;

/**
 * Class log_blood_bankRepository
 * @package App\Repositories
 * @version August 13, 2024, 3:33 pm -05
*/

class log_blood_bankRepository extends BaseRepository
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
        return log_blood_bank::class;
    }
}
