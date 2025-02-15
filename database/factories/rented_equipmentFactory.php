<?php

namespace Database\Factories;

use App\Models\rented_equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class rented_equipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = rented_equipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'art_code' => $this->faker->word,
        'description' => $this->faker->word,
        'value' => $this->faker->word,
        'specialty' => $this->faker->word,
        'procedure_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
