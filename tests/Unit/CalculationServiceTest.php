<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CalculationService;

class CalculationServiceTest extends TestCase
{
    public function test_calcualtes_the_sales_price_for_expected_values(): void
    {
        $CalculationService = new CalculationService;

        $this->assertEquals(23.33, $CalculationService->CalculateSalesPrice(1, 10));
    }

    public function test_negative_price_return_zero(): void
    {
        $CalculationService = new CalculationService;

        $this->assertEquals(0, $CalculationService->CalculateSalesPrice(1, -10));
    }

    public function test_negative_quantity_return_zero(): void
    {
        $CalculationService = new CalculationService;

        $this->assertEquals(0, $CalculationService->CalculateSalesPrice(-2, 10));
    }
}
