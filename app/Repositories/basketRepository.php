<?php

namespace App\Repositories;

use App\Models\basket;
use App\Repositories\BaseRepository;

/**
 * Class basketRepository
 * @package App\Repositories
 * @version November 30, 2023, 3:03 pm -05
*/

class basketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_quantity',
        'reusable',
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
        return basket::class;
    }
}
