<?php

namespace Database\Factories;

use App\Models\log_diferential_rates;
use Illuminate\Database\Eloquent\Factories\Factory;

class log_diferential_ratesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = log_diferential_rates::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_drate' => $this->faker->randomDigitNotNull,
        'old' => $this->faker->word,
        'nuew' => $this->faker->word,
        'observation' => $this->faker->word,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
