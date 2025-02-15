<?php

namespace App\Repositories;

use App\Models\medical_fees;
use App\Repositories\BaseRepository;

/**
 * Class medical_feesRepository
 * @package App\Repositories
 * @version November 30, 2023, 3:46 pm -05
*/

class medical_feesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'honorary_code',
        'payment_manual'
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
        return medical_fees::class;
    }
}
