<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address_line_1'=>$this->faker->streetAddress(),
            'address_city' => $this->faker->city(),
            'address_postal_code' =>$this->faker->postcode(),
            'country_id'=>1
        ];
    }
}
