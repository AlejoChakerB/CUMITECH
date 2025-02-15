<?php

namespace Database\Factories;

use App\Models\cext_production_month;
use Illuminate\Database\Eloquent\Factories\Factory;

class cext_production_monthFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = cext_production_month::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'specialty' => $this->faker->word,
        'period' => $this->faker->word,
        'january' => $this->faker->word,
        'february' => $this->faker->word,
        'march' => $this->faker->word,
        'april' => $this->faker->word,
        'may' => $this->faker->word,
        'june' => $this->faker->word,
        'july' => $this->faker->word,
        'august' => $this->faker->word,
        'september' => $this->faker->word,
        'october' => $this->faker->word,
        'november' => $this->faker->word,
        'december' => $this->faker->word,
        'average_months' => $this->faker->word,
        'average_months' => $this->faker->word,
        'duration' => $this->faker->randomDigitNotNull,
        'total_duration' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
