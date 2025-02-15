<?php

namespace Database\Factories;

use App\Models\blood_bank_month;
use Illuminate\Database\Eloquent\Factories\Factory;

class blood_bank_monthFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = blood_bank_month::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'period' => $this->faker->word,
            'january' => $this->faker->word,
            'january_value' => $this->faker->word,
            'february' => $this->faker->word,
            'february_value' => $this->faker->word,
            'march' => $this->faker->word,
            'march_value' => $this->faker->word,
            'april' => $this->faker->word,
            'april_value' => $this->faker->word,
            'may' => $this->faker->word,
            'may_value' => $this->faker->word,
            'june' => $this->faker->word,
            'june_value' => $this->faker->word,
            'july' => $this->faker->word,
            'july_value' => $this->faker->word,
            'august' => $this->faker->word,
            'august_value' => $this->faker->word,
            'september' => $this->faker->word,
            'september_value' => $this->faker->word,
            'october' => $this->faker->word,
            'october_value' => $this->faker->word,
            'november' => $this->faker->word,
            'november_value' => $this->faker->word,
            'december' => $this->faker->word,
            'december_value' => $this->faker->word,
            'average_months' => $this->faker->word,
            'unit_price' => $this->faker->word,
            'cups' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
