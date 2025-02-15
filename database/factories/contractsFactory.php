<?php

namespace Database\Factories;

use App\Models\contracts;
use Illuminate\Database\Eloquent\Factories\Factory;

class contractsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = contracts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'salary' => $this->faker->word,
            'start_date_contract' => $this->faker->word,
            'disable' => $this->faker->word,
            'employe_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
