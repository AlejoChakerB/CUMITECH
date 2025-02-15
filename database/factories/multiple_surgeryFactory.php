<?php

namespace Database\Factories;

use App\Models\multiple_surgery;
use Illuminate\Database\Eloquent\Factories\Factory;

class multiple_surgeryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = multiple_surgery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mdate_surgery' => $this->faker->word,
        'mstart_time' => $this->faker->word,
        'mend_time' => $this->faker->word,
        'msurgery_time' => $this->faker->randomDigitNotNull,
        'moperating_room' => $this->faker->word,
        'mcod_surgical_act' => $this->faker->randomDigitNotNull,
        'mstudy_number' => $this->faker->randomDigitNotNull,
        'patient' => $this->faker->word,
        'id_doctor' => $this->faker->randomDigitNotNull,
        'id_doctor2' => $this->faker->randomDigitNotNull,
        'id_anesth' => $this->faker->randomDigitNotNull,
        'id_procedures' => $this->faker->randomDigitNotNull,
        'cod_helper' => $this->faker->randomDigitNotNull,
        'cod_instrumentator' => $this->faker->randomDigitNotNull,
        'cod_rotator' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
