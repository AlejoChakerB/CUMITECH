<?php

namespace App\Repositories;

use App\Models\detail_packages_temp;
use App\Repositories\BaseRepository;

/**
 * Class detail_packages_tempRepository
 * @package App\Repositories
 * @version June 11, 2024, 12:08 pm -05
*/

class detail_packages_tempRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'cod_uf',
        'funcional_unit',
        'code_service',
        'description_service',
        'id_factu',
        'quanty',
        'recorded_cost',
        'unit_cost',
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
        return detail_packages_temp::class;
    }
}
