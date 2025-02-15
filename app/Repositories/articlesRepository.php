<?php

namespace App\Repositories;

use App\Models\articles;
use App\Repositories\BaseRepository;

/**
 * Class articlesRepository
 * @package App\Repositories
 * @version November 30, 2023, 2:32 pm -05
*/

class articlesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'item_code',
        'description',
        'average_cost',
        'last_cost'
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
        return articles::class;
    }
}
