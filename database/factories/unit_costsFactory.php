<?php

namespace Database\Factories;

use App\Models\unit_costs;
use Illuminate\Database\Eloquent\Factories\Factory;

class unit_costsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = unit_costs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_cost' => $this->faker->word,
        'gas' => $this->faker->word,
        'total_value' => $this->faker->word,
        'labour' => $this->faker->word,
        'basket' => $this->faker->word,
        'medical_fees' => $this->faker->word,
        'id_consumables' => $this->faker->randomDigitNotNull,
        'cod_surgical_act' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
