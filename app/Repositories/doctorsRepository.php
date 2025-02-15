<?php

namespace App\Repositories;

use App\Models\doctors;
use App\Repositories\BaseRepository;

/**
 * Class doctorsRepository
 * @package App\Repositories
 * @version December 1, 2023, 9:52 am -05
*/

class doctorsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dni',
        'full_name',
        'specialty',
        'id_rates',
        'id_fees'
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
        return doctors::class;
    }
}
