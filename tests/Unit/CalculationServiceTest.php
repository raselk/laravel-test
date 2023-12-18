<?php

namespace Tests\Unit;

use App\Models\CoffeeProduct;
use Tests\TestCase;
use App\Services\CalculationService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_calcualtes_the_sales_price_for_expected_values(): void
    {
        $CalculationService = new CalculationService;
        $coffeeproduct = CoffeeProduct::create([
            'name' => 'Gold Coffee',
            'profitmargin' => 0.25,
        ]);


        $this->assertEquals(23.33, $CalculationService->CalculateSalesPrice(1, 10, $coffeeproduct->id));
    }

    public function test_negative_price_return_zero(): void
    {
        $CalculationService = new CalculationService;
        $coffeeproduct = CoffeeProduct::create([
            'name' => 'Gold Coffee',
            'profitmargin' => 0.25,
        ]);


        $this->assertEquals(0, $CalculationService->CalculateSalesPrice(1, -10, $coffeeproduct->id));
    }

    public function test_negative_quantity_return_zero(): void
    {
        $CalculationService = new CalculationService;
        $coffeeproduct = CoffeeProduct::create([
            'name' => 'Gold Coffee',
            'profitmargin' => 0.25,
        ]);


        $this->assertEquals(0, $CalculationService->CalculateSalesPrice(-1, 10, $coffeeproduct->id));
    }
}
