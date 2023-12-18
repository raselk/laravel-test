<?php

namespace App\Services;

class CalculationService
{
    protected $profitmargin = 0.25;
    protected $shippingcost = 10;



    public function CalculateSalesPrice($quantity, $unitcost)
    {
        if ($quantity < 0) return 0;
        if ($unitcost < 0) return 0;

        $cost = $quantity * $unitcost;
        $sellingprice = round(($cost / (1 - $this->profitmargin)) + $this->shippingcost, 2);

        return $sellingprice;
    }
}
