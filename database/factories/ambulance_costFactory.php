<?php

namespace Database\Factories;

use App\Models\ambulance_cost;
use Illuminate\Database\Eloquent\Factories\Factory;

class ambulance_costFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ambulance_cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'CUPS' => $this->faker->word,
        'name' => $this->faker->word,
        'value' => $this->faker->word,
        'recharge' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
