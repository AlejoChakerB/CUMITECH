<?php

namespace App\Repositories;

use App\Models\detail_package;
use App\Repositories\BaseRepository;

/**
 * Class detail_packageRepository
 * @package App\Repositories
 * @version June 11, 2024, 9:18 am -05
*/

class detail_packageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Description',
        'cod_uf',
        'funcional_unit',
        'code_service',
        'description_service',
        'id_factu',
        'quanty',
        'unit_cost',
        'recorded_cost'
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
        return detail_package::class;
    }
}
