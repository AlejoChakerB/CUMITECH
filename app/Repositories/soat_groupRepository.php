<?php

namespace App\Repositories;

use App\Models\soat_group;
use App\Repositories\BaseRepository;

/**
 * Class soat_groupRepository
 * @package App\Repositories
 * @version January 23, 2024, 10:33 am -05
*/

class soat_groupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'group',
        'surgeon',
        'anesthed',
        'assistant',
        'room',
        'materials',
        'total'
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
        return soat_group::class;
    }
}
