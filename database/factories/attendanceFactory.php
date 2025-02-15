<?php

namespace Database\Factories;

use App\Models\attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class attendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'workday' => $this->faker->date('Y-m-d'),
            'aentry_time' => $this->faker->word,
            'adeparture_time' => $this->faker->word,
            'minutes' => $this->faker->randomDigitNotNull,
            'employe_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
