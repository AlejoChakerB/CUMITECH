<?php

namespace Database\Factories;

use App\Models\cext_details;
use Illuminate\Database\Eloquent\Factories\Factory;

class cext_detailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = cext_details::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'specialty' => $this->faker->word,
        'procedure' => $this->faker->word,
        'duration' => $this->faker->randomDigitNotNull,
        'room_cost' => $this->faker->word,
        'medical_fees' => $this->faker->word,
        'supplies_cost' => $this->faker->word,
        'total_cost' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
