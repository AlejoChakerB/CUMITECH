<?php

namespace App\Repositories;

use App\Models\imaging_production;
use App\Repositories\BaseRepository;

/**
 * Class imaging_productionRepository
 * @package App\Repositories
 * @version March 21, 2024, 10:16 am -05
*/

class imaging_productionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'go_study',
        'id_order',
        'modality',
        'dni_patient',
        'name_patient',
        'income',
        'contract',
        'date',
        'hour',
        'cod_medi',
        'cups'
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
        return imaging_production::class;
    }
}
