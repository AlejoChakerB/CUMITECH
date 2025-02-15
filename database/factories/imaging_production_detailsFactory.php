<?php

namespace Database\Factories;

use App\Models\imaging_production_details;
use Illuminate\Database\Eloquent\Factories\Factory;

class imaging_production_detailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = imaging_production_details::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service' => $this->faker->word,
        'duration' => $this->faker->randomDigitNotNull,
        'room_cost' => $this->faker->word,
        'transcriber_cost' => $this->faker->word,
        'doctor_cost' => $this->faker->word,
        'supplies_cost' => $this->faker->word,
        'total_cost' => $this->faker->word,
        'cups' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
