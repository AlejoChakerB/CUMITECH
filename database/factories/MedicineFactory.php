<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medicine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admission_date' => $this->faker->word,
            'act_number' => $this->faker->randomDigitNotNull,
            'generic_name' => $this->faker->word,
            'tradename' => $this->faker->word,
            'concentration' => $this->faker->word,
            'pharmaceutical_form' => $this->faker->word,
            'presentation' => $this->faker->word,
            'expiration_date' => $this->faker->word,
            'lot_number' => $this->faker->word,
            'invima_registrations_id' => $this->faker->randomDigitNotNull,
            'registration_validity' => $this->faker->word,
            'observation_record' => $this->faker->word,
            'manufacturer_laboratory' => $this->faker->word,
            'supplier' => $this->faker->word,
            'invoice_number' => $this->faker->word,
            'received_amount' => $this->faker->randomDigitNotNull,
            'purchase_order' => $this->faker->word,
            'entered_by' => $this->faker->word,
            'sample' => $this->faker->randomDigitNotNull,
            'lettering' => $this->faker->word,
            'packing' => $this->faker->word,
            'laminate' => $this->faker->word,
            'closing' => $this->faker->word,
            'all' => $this->faker->word,
            'liquids' => $this->faker->word,
            'semisolid' => $this->faker->word,
            'dust' => $this->faker->word,
            'tablet' => $this->faker->word,
            'capsule' => $this->faker->word,
            'arrival_temperature' => $this->faker->word,
            'observations' => $this->faker->word,
            'state' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
