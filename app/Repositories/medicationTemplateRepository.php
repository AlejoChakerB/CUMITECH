<?php

namespace App\Repositories;

use App\Models\medicationTemplate;
use App\Repositories\BaseRepository;

/**
 * Class medicationTemplateRepository
 * @package App\Repositories
 * @version August 28, 2023, 12:09 pm -05
*/

class medicationTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'template_name',
        'generic_namet',
        'tradenamet',
        'concentrationt',
        'pharmaceutical_formt',
        'presentationt',
        'registration_validityt',
        'manufacturer_laboratoryt',
        'received_amountt',
        'samplet',
        'invima_registrations_id'
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
        return medicationTemplate::class;
    }
}
