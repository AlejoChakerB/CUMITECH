<?php

namespace Database\Factories;

use App\Models\medicationTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class medicationTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = medicationTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'template_name' => $this->faker->word,
            'concentrationt' => $this->faker->word,
            'presentationt' => $this->faker->word,
            'received_amountt' => $this->faker->randomDigitNotNull,
            'samplet' => $this->faker->randomDigitNotNull,
            'invima_registrations_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
