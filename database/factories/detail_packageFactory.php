<?php

namespace Database\Factories;

use App\Models\detail_package;
use Illuminate\Database\Eloquent\Factories\Factory;

class detail_packageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = detail_package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Description' => $this->faker->word,
        'cod_uf' => $this->faker->randomDigitNotNull,
        'funcional_unit' => $this->faker->word,
        'code_service' => $this->faker->word,
        'description_service' => $this->faker->word,
        'id_factu' => $this->faker->randomDigitNotNull,
        'quanty' => $this->faker->randomDigitNotNull,
        'unit_cost' => $this->faker->word,
        'recorded_cost' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
