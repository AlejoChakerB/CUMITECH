<?php

namespace App\Repositories;

use App\Models\log_diferential_rates;
use App\Repositories\BaseRepository;

/**
 * Class log_diferential_ratesRepository
 * @package App\Repositories
 * @version August 12, 2024, 11:29 am -05
*/

class log_diferential_ratesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_drate',
        'old',
        'nuew',
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
        return log_diferential_rates::class;
    }
}
