<?php

namespace Database\Factories;

use App\Models\diferential_rates;
use Illuminate\Database\Eloquent\Factories\Factory;

class diferential_ratesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = diferential_rates::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rate_code' => $this->faker->randomDigitNotNull,
        'rate_description' => $this->faker->word,
        'value' => $this->faker->word,
        'id_procedure' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
