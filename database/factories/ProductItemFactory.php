<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductItem>
 */
class ProductItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_item_sku'=>$this->faker->regexify('^[A-Z0-9]{8}$'),
            'product_item_quantity_in_stock'=>$this->faker->numberBetween(0,20),
            'product_item_price'=>$this->faker->randomFloat(2,5,20)
        ];
    }
}
