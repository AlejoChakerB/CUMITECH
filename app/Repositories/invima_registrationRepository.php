<?php

namespace App\Repositories;

use App\Models\invima_registration;
use App\Repositories\BaseRepository;

/**
 * Class invima_registrationRepository
 * @package App\Repositories
 * @version August 28, 2023, 10:04 am -05
*/

class invima_registrationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'health_register',
        'validity_registration',
        'laboratory_manufacturer'
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
        return invima_registration::class;
    }
}
