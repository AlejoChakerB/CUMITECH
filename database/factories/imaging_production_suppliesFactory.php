<?php

namespace Database\Factories;

use App\Models\imaging_production_supplies;
use Illuminate\Database\Eloquent\Factories\Factory;

class imaging_production_suppliesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = imaging_production_supplies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount_day' => $this->faker->word,
        'amount_weekend' => $this->faker->word,
        'unit_price' => $this->faker->word,
        'id_article' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
