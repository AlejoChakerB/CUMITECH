<?php

namespace Database\Factories;

use App\Models\stand_assistance;
use Illuminate\Database\Eloquent\Factories\Factory;

class stand_assistanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = stand_assistance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stand' => $this->faker->word,
        'state' => $this->faker->word,
        'approved_date' => $this->faker->word,
        'id_user_employees' => $this->faker->randomDigitNotNull,
        'id_presenter' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
