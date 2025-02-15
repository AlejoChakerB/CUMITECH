<?php

namespace Database\Factories;

use App\Models\msurgery_procedure;
use Illuminate\Database\Eloquent\Factories\Factory;

class msurgery_procedureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = msurgery_procedure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomDigitNotNull,
        'type' => $this->faker->word,
        'mcod_surgical_act' => $this->faker->randomDigitNotNull,
        'code_procedure' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
