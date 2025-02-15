<?php

namespace Database\Factories;

use App\Models\surgery;
use Illuminate\Database\Eloquent\Factories\Factory;

class surgeryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = surgery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => $this->faker->word,
        'end_time' => $this->faker->word,
        'operating_room' => $this->faker->word,
        'cod_surgical_act' => $this->faker->randomDigitNotNull,
        'study_number' => $this->faker->randomDigitNotNull,
        'patient' => $this->faker->randomDigitNotNull,
        'name_patient' => $this->faker->word,
        'id_doctor' => $this->faker->randomDigitNotNull,
        'id_assistant_doctor' => $this->faker->randomDigitNotNull,
        'id_anesthesiologist' => $this->faker->randomDigitNotNull,
        'id_labours' => $this->faker->randomDigitNotNull,
        'id_procedures' => $this->faker->randomDigitNotNull,
        'id_baskets' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
