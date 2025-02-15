<?php

namespace App\Repositories;

use App\Models\procedures_homologator;
use App\Repositories\BaseRepository;

/**
 * Class procedures_homologatorRepository
 * @package App\Repositories
 * @version June 20, 2024, 4:36 pm -05
*/

class procedures_homologatorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cups',
        'cups_soat',
        'description_soat',
        'cups_iss',
        'description_iss',
        'service_reps',
        'category',
        'group',
        'subgroup',
        'uvr',
        'honorary_iss',
        'anest_iss',
        'helper_iss',
        'room_iss',
        'materials_iss',
        'value_iss',
        'uvt',
        'honorary_soat',
        'anest_soat',
        'helper_soat',
        'room_soat',
        'materials_soat',
        'value_soat',
        'observation'
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
        return procedures_homologator::class;
    }
}
