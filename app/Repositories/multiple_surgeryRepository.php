<?php

namespace App\Repositories;

use App\Models\multiple_surgery;
use App\Repositories\BaseRepository;

/**
 * Class multiple_surgeryRepository
 * @package App\Repositories
 * @version January 25, 2024, 4:48 pm -05
*/

class multiple_surgeryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'mdate_surgery',
        'mstart_time',
        'mend_time',
        'msurgery_time',
        'moperating_room',
        'mcod_surgical_act',
        'mstudy_number',
        'patient',
        'id_doctor',
        'id_doctor2',
        'id_anesth',
        'id_procedures',
        'cod_helper',
        'cod_instrumentator',
        'cod_rotator'
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
        return multiple_surgery::class;
    }
}
