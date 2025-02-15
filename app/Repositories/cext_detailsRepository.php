<?php

namespace App\Repositories;

use App\Models\cext_details;
use App\Repositories\BaseRepository;

/**
 * Class cext_detailsRepository
 * @package App\Repositories
 * @version April 11, 2024, 3:07 pm -05
*/

class cext_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'specialty',
        'procedure',
        'duration',
        'room_cost',
        'medical_fees',
        'supplies_cost',
        'total_cost'
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
        return cext_details::class;
    }
}
