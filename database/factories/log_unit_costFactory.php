<?php

namespace Database\Factories;

use App\Models\log_unit_cost;
use Illuminate\Database\Eloquent\Factories\Factory;

class log_unit_costFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = log_unit_cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cod_surgical_act' => $this->faker->randomDigitNotNull,
        'old' => $this->faker->word,
        'new' => $this->faker->word,
        'observation' => $this->faker->word,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
