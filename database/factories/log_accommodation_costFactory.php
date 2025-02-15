<?php

namespace Database\Factories;

use App\Models\log_accommodation_cost;
use Illuminate\Database\Eloquent\Factories\Factory;

class log_accommodation_costFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = log_accommodation_cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomDigitNotNull,
        'old' => $this->faker->word,
        'new' => $this->faker->word,
        'observation' => $this->faker->word,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
