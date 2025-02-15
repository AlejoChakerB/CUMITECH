<?php

namespace App\Repositories;

use App\Models\endowment;
use App\Repositories\BaseRepository;

/**
 * Class endowmentRepository
 * @package App\Repositories
 * @version June 5, 2023, 12:01 pm -05
*/

class endowmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item',
        'deliver_date',
        'employe_signature',
        'contract_id'
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
        return endowment::class;
    }
}
