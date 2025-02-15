<?php

namespace Database\Factories;

use App\Models\procedures_homologator;
use Illuminate\Database\Eloquent\Factories\Factory;

class procedures_homologatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = procedures_homologator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cups' => $this->faker->word,
        'cups_soat' => $this->faker->word,
        'description_soat' => $this->faker->word,
        'cups_iss' => $this->faker->word,
        'description_iss' => $this->faker->word,
        'service_reps' => $this->faker->word,
        'category' => $this->faker->word,
        'group' => $this->faker->word,
        'subgroup' => $this->faker->word,
        'uvr' => $this->faker->randomDigitNotNull,
        'honorary_iss' => $this->faker->word,
        'anest_iss' => $this->faker->word,
        'helper_iss' => $this->faker->word,
        'room_iss' => $this->faker->word,
        'materials_iss' => $this->faker->word,
        'value_iss' => $this->faker->word,
        'uvt' => $this->faker->randomDigitNotNull,
        'honorary_soat' => $this->faker->word,
        'anest_soat' => $this->faker->word,
        'helper_soat' => $this->faker->word,
        'room_soat' => $this->faker->word,
        'materials_soat' => $this->faker->word,
        'value_soat' => $this->faker->word,
        'observation' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
