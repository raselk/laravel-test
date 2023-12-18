<?php

namespace App\Services;

use App\Models\CoffeeProduct;

class CalculationService
{
    protected $profitmargin = 0.25;
    protected $shippingcost = 10;



    public function CalculateSalesPrice($quantity, $unitcost, $productid)
    {
        if ($quantity < 0) return 0;
        if ($unitcost < 0) return 0;

        $cost = $quantity * $unitcost;

        $profitmargin = CoffeeProduct::find($productid)->profitmargin;

        $sellingprice = round(($cost / (1 - $profitmargin)) + $this->shippingcost, 2);
        $sellingprice = $sellingprice > 0 ? $sellingprice : 0;

        return $sellingprice;
    }
}
