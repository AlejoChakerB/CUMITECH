<?php

namespace Database\Factories;

use App\Models\consumable;
use Illuminate\Database\Eloquent\Factories\Factory;

class consumableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = consumable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'consumable_quantity' => $this->faker->randomDigitNotNull,
        'surgery_type' => $this->faker->randomDigitNotNull,
        'id_article' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
