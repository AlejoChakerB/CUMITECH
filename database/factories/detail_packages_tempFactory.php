<?php

namespace Database\Factories;

use App\Models\detail_packages_temp;
use Illuminate\Database\Eloquent\Factories\Factory;

class detail_packages_tempFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = detail_packages_temp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->word,
        'cod_uf' => $this->faker->randomDigitNotNull,
        'funcional_unit' => $this->faker->word,
        'code_service' => $this->faker->word,
        'description_service' => $this->faker->word,
        'id_factu' => $this->faker->randomDigitNotNull,
        'quanty' => $this->faker->randomDigitNotNull,
        'recorded_cost' => $this->faker->word,
        'unit_cost' => $this->faker->word,
        'observation' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
