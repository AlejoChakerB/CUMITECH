<?php

namespace App\Repositories;

use App\Models\dist_package;
use App\Repositories\BaseRepository;

/**
 * Class dist_packageRepository
 * @package App\Repositories
 * @version May 20, 2024, 11:59 am -05
*/

class dist_packageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'value',
        'cod_package',
        'code_procedure',
        'cod_procedure'
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
        return dist_package::class;
    }
}
