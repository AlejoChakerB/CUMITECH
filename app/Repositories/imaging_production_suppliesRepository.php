<?php

namespace App\Repositories;

use App\Models\imaging_production_supplies;
use App\Repositories\BaseRepository;

/**
 * Class imaging_production_suppliesRepository
 * @package App\Repositories
 * @version April 4, 2024, 2:50 pm -05
*/

class imaging_production_suppliesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount_day',
        'amount_weekend',
        'unit_price',
        'id_article'
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
        return imaging_production_supplies::class;
    }
}
