<?php

namespace Database\Factories;

use App\Models\imaging_production;
use Illuminate\Database\Eloquent\Factories\Factory;

class imaging_productionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = imaging_production::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'go_study' => $this->faker->word,
        'id_order' => $this->faker->randomDigitNotNull,
        'modality' => $this->faker->word,
        'dni_patient' => $this->faker->randomDigitNotNull,
        'name_patient' => $this->faker->word,
        'income' => $this->faker->word,
        'contract' => $this->faker->word,
        'date' => $this->faker->word,
        'hour' => $this->faker->word,
        'cod_medi' => $this->faker->randomDigitNotNull,
        'cups' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
