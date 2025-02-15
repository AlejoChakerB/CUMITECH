<?php

namespace App\Repositories;

use App\Models\general_costs;
use App\Repositories\BaseRepository;

/**
 * Class general_costsRepository
 * @package App\Repositories
 * @version December 1, 2023, 11:16 am -05
*/

class general_costsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'value_roomTime',
        'value_gases',
        'value_operatingRoom',
        'value_RoomCardio'
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
        return general_costs::class;
    }
}
