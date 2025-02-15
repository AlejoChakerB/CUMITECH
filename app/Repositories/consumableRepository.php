<?php

namespace App\Repositories;

use App\Models\consumable;
use App\Repositories\BaseRepository;

/**
 * Class consumableRepository
 * @package App\Repositories
 * @version November 30, 2023, 3:26 pm -05
*/

class consumableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'consumable_quantity',
        'level',
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
        return consumable::class;
    }
}
