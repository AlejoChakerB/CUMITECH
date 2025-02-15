<?php

namespace App\Repositories;

use App\Models\contracts;
use App\Repositories\BaseRepository;

/**
 * Class contractsRepository
 * @package App\Repositories
 * @version June 5, 2023, 8:51 am -05
*/

class contractsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'salary',
        'start_date_contract',
        'employe_id'
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
        return contracts::class;
    }
}
