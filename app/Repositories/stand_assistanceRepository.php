<?php

namespace App\Repositories;

use App\Models\stand_assistance;
use App\Repositories\BaseRepository;

/**
 * Class stand_assistanceRepository
 * @package App\Repositories
 * @version September 24, 2024, 9:53 am -05
*/

class stand_assistanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stand',
        'state',
        'approved_date',
        'id_user_employees',
        'id_presenter'
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
        return stand_assistance::class;
    }
}
