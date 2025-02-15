<?php

namespace Database\Factories;

use App\Models\articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class articlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = articles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'item_code' => $this->faker->randomDigitNotNull,
            'description' => $this->faker->word,
            'average_cost' => $this->faker->word,
            'last_cost' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
