<?php

namespace App\Repositories;

use App\Models\log_imaging_production_detail;
use App\Repositories\BaseRepository;

/**
 * Class log_imaging_production_detailRepository
 * @package App\Repositories
 * @version August 13, 2024, 12:23 pm -05
*/

class log_imaging_production_detailRepository extends BaseRepository
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
        return log_imaging_production_detail::class;
    }
}
