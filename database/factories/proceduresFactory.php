<?php

namespace Database\Factories;

use App\Models\procedures;
use Illuminate\Database\Eloquent\Factories\Factory;

class proceduresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = procedures::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'procedure_code' => $this->faker->word,
            'manual_type' => $this->faker->word,
            'description' => $this->faker->word,
            'cups' => $this->faker->word,
            'uvr' => $this->faker->randomDigitNotNull,
            'procedure_value' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
