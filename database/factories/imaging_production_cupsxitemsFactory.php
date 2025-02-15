<?php

namespace Database\Factories;

use App\Models\imaging_production_cupsxitems;
use Illuminate\Database\Eloquent\Factories\Factory;

class imaging_production_cupsxitemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = imaging_production_cupsxitems::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service' => $this->faker->word,
        'category' => $this->faker->word,
        'sub_category' => $this->faker->word,
        'cups' => $this->faker->word,
        'items' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
