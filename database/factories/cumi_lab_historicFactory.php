<?php

namespace Database\Factories;

use App\Models\cumi_lab_historic;
use Illuminate\Database\Eloquent\Factories\Factory;

class cumi_lab_historicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = cumi_lab_historic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'period' => $this->faker->word,
        'january' => $this->faker->word,
        'february' => $this->faker->word,
        'march' => $this->faker->word,
        'april' => $this->faker->word,
        'may' => $this->faker->word,
        'june' => $this->faker->word,
        'july' => $this->faker->word,
        'august' => $this->faker->word,
        'september' => $this->faker->word,
        'october' => $this->faker->word,
        'november' => $this->faker->word,
        'december' => $this->faker->word,
        'total_months' => $this->faker->word,
        'average_months' => $this->faker->word,
        'cumilab_rate' => $this->faker->word,
        'mutual_rate' => $this->faker->word,
        'pxq' => $this->faker->word,
        'part_percentage' => $this->faker->word,
        'adminlog' => $this->faker->word,
        'adminlog_percentage' => $this->faker->word,
        'cd' => $this->faker->word,
        'cd_percentage' => $this->faker->word,
        'total' => $this->faker->word,
        'cups' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
