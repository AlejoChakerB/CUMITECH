<?php

namespace Database\Factories;

use App\Models\endowment;
use Illuminate\Database\Eloquent\Factories\Factory;

class endowmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = endowment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item' => $this->faker->word,
            'deliver_date' => $this->faker->word,
            'employe_signature' => $this->faker->text,
            'period' => $this->faker->word,
            'contract_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
