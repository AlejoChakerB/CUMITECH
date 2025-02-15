<?php

namespace App\Repositories;

use App\Models\card;
use App\Repositories\BaseRepository;

/**
 * Class cardRepository
 * @package App\Repositories
 * @version June 14, 2023, 2:11 pm -05
*/

class cardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'delivery_date_card',
        'signature_employe_card',
        'card_item',
        'employe_id'
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
        return card::class;
    }
}
