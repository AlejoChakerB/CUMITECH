<?php

namespace Database\Factories;

use App\Models\cext_hourcost;
use Illuminate\Database\Eloquent\Factories\Factory;

class cext_hourcostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = cext_hourcost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'permanent_overhead' => $this->faker->word,
        'variable_overhead' => $this->faker->word,
        'administrative_twoLevel' => $this->faker->word,
        'logistic_twoLevel' => $this->faker->word,
        'plant_labour' => $this->faker->word,
        'labour' => $this->faker->word,
        'total_cost' => $this->faker->word,
        'days_produced' => $this->faker->randomDigitNotNull,
        'hours_producedxday' => $this->faker->word,
        'hours_producedxmonth' => $this->faker->word,
        'room_valueTotal' => $this->faker->word,
        'room_value' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
