<?php

namespace Database\Factories;

use App\Models\log_details_unitCost;
use Illuminate\Database\Eloquent\Factories\Factory;

class log_details_unitCostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = log_details_unitCost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_operation_cost' => $this->faker->randomDigitNotNull,
        'old' => $this->faker->word,
        'new' => $this->faker->word,
        'observation' => $this->faker->word,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
