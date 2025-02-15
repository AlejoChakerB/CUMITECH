<?php

namespace App\Repositories;

use App\Models\surgery;
use App\Repositories\BaseRepository;

/**
 * Class surgeryRepository
 * @package App\Repositories
 * @version December 1, 2023, 10:26 am -05
*/

class surgeryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'start_time',
        'end_time',
        'surgeryTime',
        'operating_room',
        'cod_surgical_act',
        'study_number',
        'patient',
        'name_patient',
        'labours',
        'id_doctor',
        'id_doctor2',
        'id_anesthesiologist',
        'id_procedures'
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
        return surgery::class;
    }
}
