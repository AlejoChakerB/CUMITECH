<?php

namespace Database\Factories;

use App\Models\log_operation_cost;
use Illuminate\Database\Eloquent\Factories\Factory;

class log_operation_costFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = log_operation_cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'percentage_uvr' => $this->faker->randomDigitNotNull,
        'time_procedure' => $this->faker->word,
        'doctor_percentage' => $this->faker->randomDigitNotNull,
        'doctor_fees' => $this->faker->word,
        'anest_percentage' => $this->faker->randomDigitNotNull,
        'anest_fees' => $this->faker->word,
        'total_uvr' => $this->faker->randomDigitNotNull,
        'room_cost' => $this->faker->word,
        'gases' => $this->faker->word,
        'labour' => $this->faker->word,
        'cod_surgical_act' => $this->faker->randomDigitNotNull,
        'code_procedure' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
