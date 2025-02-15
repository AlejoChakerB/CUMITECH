<?php

namespace App\Repositories;

use App\Models\diferential_rates;
use App\Repositories\BaseRepository;

/**
 * Class diferential_ratesRepository
 * @package App\Repositories
 * @version December 1, 2023, 9:32 am -05
*/

class diferential_ratesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rate_code',
        'rate_description',
        'value',
        'id_procedure'
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
        return diferential_rates::class;
    }
}
