<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Services\CalculationService;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request, CalculationService $CalculationService)
    {
        $quantiy = $request->quantity;
        $unitcost = $request->unitcost;
        $productid = $request->productid;
        $sellingprice = $CalculationService->calculateSalesPrice($quantiy, $unitcost, $productid);

        sale::create([
            'productid' => $productid,
            'quantity' => $quantiy,
            'unitcost' => $unitcost,
            'sellingprice' => $sellingprice,
        ]);

        return redirect(route('coffee.sales'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function calculateSalesPrice(Request $request, CalculationService $CalculationService)
    {
        $quantiy = $request->quantity;
        $unitcost = $request->unitcost;
        $productid = $request->productid;
        $sellingprice = $CalculationService->calculateSalesPrice($quantiy, $unitcost, $productid);


        return  response()->json(['sellingprice' => $sellingprice]);
    }
}
