<?php

namespace Database\Factories;

use App\Models\dist_package;
use Illuminate\Database\Eloquent\Factories\Factory;

class dist_packageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = dist_package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->word,
        'value' => $this->faker->word,
        'cod_package' => $this->faker->randomDigitNotNull,
        'code_procedure' => $this->faker->word,
        'cod_procedure' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
