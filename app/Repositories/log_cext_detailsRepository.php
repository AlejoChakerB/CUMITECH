<?php

namespace App\Repositories;

use App\Models\log_cext_details;
use App\Repositories\BaseRepository;

/**
 * Class log_cext_detailsRepository
 * @package App\Repositories
 * @version August 13, 2024, 2:08 pm -05
*/

class log_cext_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_cextDetail',
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
        return log_cext_details::class;
    }
}
