<?php

namespace Database\Factories;

use App\Models\doctors;
use Illuminate\Database\Eloquent\Factories\Factory;

class doctorsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = doctors::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dni' => $this->faker->randomDigitNotNull,
        'full_name' => $this->faker->word,
        'specialty' => $this->faker->word,
        'id_rates' => $this->faker->randomDigitNotNull,
        'id_fees' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
