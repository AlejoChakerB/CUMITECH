<?php

namespace Database\Factories;

use App\Models\card;
use Illuminate\Database\Eloquent\Factories\Factory;

class cardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'delivery_date_card' => $this->faker->word,
        'signature_employe_card' => $this->faker->text,
        'card_item' => $this->faker->word,
        'employe_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
