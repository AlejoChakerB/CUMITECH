<?php

namespace Database\Factories;

use App\Models\basket;
use Illuminate\Database\Eloquent\Factories\Factory;

class basketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = basket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_quantity' => $this->faker->randomDigitNotNull,
        'reusable' => $this->faker->randomDigitNotNull,
        'basket_value' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
