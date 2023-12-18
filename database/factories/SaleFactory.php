<?php

namespace Database\Factories;

use App\Services\CalculationService;
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

        $quantity = rand(1, 10);
        $unitcost = fake()->randomFloat(2, 5, 25);
        $sellingprice = (new CalculationService)->CalculateSalesPrice($quantity, $unitcost);
        return [
            'quantity' => $quantity,
            'unitcost' => $unitcost,
            'sellingprice' => $sellingprice,
        ];
    }
}
