<?php

namespace Database\Factories;

use App\Models\patology;
use Illuminate\Database\Eloquent\Factories\Factory;

class patologyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = patology::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service' => $this->faker->word,
        'cups' => $this->faker->word,
        'description' => $this->faker->word,
        'value' => $this->faker->word,
        'observation' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
