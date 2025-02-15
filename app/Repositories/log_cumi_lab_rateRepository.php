<?php

namespace App\Repositories;

use App\Models\log_cumi_lab_rate;
use App\Repositories\BaseRepository;

/**
 * Class log_cumi_lab_rateRepository
 * @package App\Repositories
 * @version August 13, 2024, 2:53 pm -05
*/

class log_cumi_lab_rateRepository extends BaseRepository
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
        return log_cumi_lab_rate::class;
    }
}
