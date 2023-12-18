<?php

namespace Database\Factories;

use App\Models\CoffeeProduct;
use App\Services\CalculationService;
use Database\Seeders\CoffeeProductSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = CoffeeProduct::factory()->create();


        $quantity = rand(1, 10);
        $unitcost = fake()->randomFloat(2, 5, 25);
        $sellingprice = (new CalculationService)->CalculateSalesPrice($quantity, $unitcost, $product->id);
        return [
            'productid' => $product->id,
            'quantity' => $quantity,
            'unitcost' => $unitcost,
            'sellingprice' => $sellingprice,
        ];
    }
}
