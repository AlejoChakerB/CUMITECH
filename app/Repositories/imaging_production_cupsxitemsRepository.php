<?php

namespace App\Repositories;

use App\Models\imaging_production_cupsxitems;
use App\Repositories\BaseRepository;

/**
 * Class imaging_production_cupsxitemsRepository
 * @package App\Repositories
 * @version April 6, 2024, 9:20 am -05
*/

class imaging_production_cupsxitemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'service',
        'category',
        'sub_category',
        'cups',
        'items'
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
        return imaging_production_cupsxitems::class;
    }
}
