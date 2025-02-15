<?php

namespace Database\Factories;

use App\Models\doctors_changes;
use Illuminate\Database\Eloquent\Factories\Factory;

class doctors_changesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = doctors_changes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code_doctor' => $this->faker->randomDigitNotNull,
        'old' => $this->faker->word,
        'new' => $this->faker->word,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
