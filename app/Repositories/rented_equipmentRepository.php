<?php

namespace App\Repositories;

use App\Models\rented_equipment;
use App\Repositories\BaseRepository;

/**
 * Class rented_equipmentRepository
 * @package App\Repositories
 * @version March 5, 2024, 4:54 pm -05
*/

class rented_equipmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'art_code',
        'description',
        'value',
        'specialty',
        'procedure_id'
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
        return rented_equipment::class;
    }
}
