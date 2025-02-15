<?php

namespace Database\Factories;

use App\Models\user_employees;
use Illuminate\Database\Eloquent\Factories\Factory;

class user_employeesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = user_employees::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => $this->faker->randomDigitNotNull,
        'id_employees' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
