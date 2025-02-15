<?php

namespace Database\Factories;

use App\Models\calendar;
use Illuminate\Database\Eloquent\Factories\Factory;

class calendarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = calendar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date('Y-m-d'),
            'end_date' => $this->faker->date('Y-m-d'),
            'entry_time' => $this->faker->word,
            'departure_time' => $this->faker->word,
            'floor' => $this->faker->word,
            'employe_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
