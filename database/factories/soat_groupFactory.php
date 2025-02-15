<?php

namespace Database\Factories;

use App\Models\soat_group;
use Illuminate\Database\Eloquent\Factories\Factory;

class soat_groupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = soat_group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group' => $this->faker->randomDigitNotNull,
        'surgeon' => $this->faker->word,
        'anesthed' => $this->faker->word,
        'assistant' => $this->faker->word,
        'room' => $this->faker->word,
        'materials' => $this->faker->word,
        'total' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
