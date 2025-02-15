<?php

namespace Database\Factories;

use App\Models\employe;
use Illuminate\Database\Eloquent\Factories\Factory;

class employeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = employe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dni' => $this->faker->randomDigitNotNull,
            'name' => $this->faker->word,
            'work_position' => $this->faker->word,
            'unit' => $this->faker->word,
            'cost_center' => $this->faker->word,
            'service' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
