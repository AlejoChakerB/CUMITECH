<?php

namespace Database\Factories;

use App\Models\imaging_production_hourcost;
use Illuminate\Database\Eloquent\Factories\Factory;

class imaging_production_hourcostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = imaging_production_hourcost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service' => $this->faker->word,
        'permanent_overhead' => $this->faker->word,
        'variable_overhead' => $this->faker->word,
        'administrative_twoLevel' => $this->faker->word,
        'logistic_twoLevel' => $this->faker->word,
        'plant_labour' => $this->faker->word,
        'labour' => $this->faker->word,
        'total_cost' => $this->faker->word,
        'employee' => $this->faker->word,
        'hour_value' => $this->faker->word,
        'number_rooms' => $this->faker->randomDigitNotNull,
        'hour_value_room' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
