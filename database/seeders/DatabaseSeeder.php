<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\PaymentType;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;
use App\Models\ProductItemImage;
use Database\Factories\CartFactory;
use Illuminate\Support\Facades\Hash;
use Database\Factories\ProductFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        PaymentType::create([
            'payment_type_value'=>'credit card'
        ]);

        ShippingMethod::factory()->create([
            'shipping_method_name' => 'Express',
            'shipping_method_price' => 10
        ]);
        ShippingMethod::factory()->create([
            'shipping_method_name' => 'Standard',
            'shipping_method_price' => 5
        ]);

        Country::create([
            'country_name' => 'United States'
        ]);
        $user = User::factory()->has(Address::factory()->count(2))->create([
            'username' => 'memo2332',
            'email' => 'm.ozd23@gmail.com',
            'lastname' => 'ozdemir',
            'firstname' => 'mehmet',
            'password' => Hash::make('blablabla')
        ]);

        $category_names = ['chip carving', 'relief carving', 'whittling'];
        foreach ($category_names as $name) {
            Category::factory()->create(['category_name' => $name]);
        }


        Cart::factory()->for($user)->create();

        for ($i = 0; $i < 21; $i++) {
            $product = Product::factory()->create([
                'category_id' => $i % 3 + 1
            ]);
            ProductItem::factory()
                ->has(ProductItemImage::factory()->count(3), 'images')
                ->for(
                    $product
                )
                ->create();
        }
    }
}
