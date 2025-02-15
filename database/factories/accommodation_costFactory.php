<?php

namespace Database\Factories;

use App\Models\accommodation_cost;
use Illuminate\Database\Eloquent\Factories\Factory;

class accommodation_costFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = accommodation_cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'year' => $this->faker->word,
        'month' => $this->faker->word,
        'service' => $this->faker->word,
        'bedrooms' => $this->faker->randomDigitNotNull,
        'beds' => $this->faker->randomDigitNotNull,
        'days_produced' => $this->faker->randomDigitNotNull,
        'hours_produced' => $this->faker->word,
        'minutes_produced' => $this->faker->word,
        'permanent_overhead' => $this->faker->word,
        'variable_overhead' => $this->faker->word,
        'administrative_twoLevel' => $this->faker->word,
        'logistic_twoLevel' => $this->faker->word,
        'plant_labour' => $this->faker->word,
        'labour' => $this->faker->word,
        'total_cost' => $this->faker->word,
        'daily_cost' => $this->faker->word,
        'bedxday_cost' => $this->faker->word,
        'hourAccommodation_cost' => $this->faker->word,
        'bedxhour_cost' => $this->faker->word,
        'bedxminute_cost' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
