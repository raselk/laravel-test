<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\CoffeeProduct;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user(): void
    {
        $response = $this->get('/api/sales/calculateSalesPrice');

        $response->assertStatus(405);
    }

    public function test_authorised_user_calculate(): void
    {
        $user = User::factory()->create();

        $coffeeproduct = CoffeeProduct::create([
            'name' => 'Gold Coffee',
            'profitmargin' => 0.25,
        ]);


        $response = $this->actingAs($user)->postJson('/api/sales/calculateSalesPrice', [
            'quantity' => 1,
            'unitcost' => 10,
            'productid' => $coffeeproduct->id
        ]);

        $response->assertStatus(200);
        $response->assertJson(['sellingprice' => 23.33]);
    }


    public function test_negative_quantity_parameter_zero_expected(): void
    {
        $user = User::factory()->create();

        $coffeeproduct = CoffeeProduct::create([
            'name' => 'Gold Coffee',
            'profitmargin' => 0.25,
        ]);


        $response = $this->actingAs($user)->postJson('/api/sales/calculateSalesPrice', [
            'quantity' => 1,
            'unitcost' => -10,
            'productid' => $coffeeproduct->id
        ]);

        $response->assertStatus(200);
        $response->assertJson(['sellingprice' => 0]);
    }


    public function test_negative_unitcost_parameter_zero_expected(): void
    {
        $user = User::factory()->create();

        $coffeeproduct = CoffeeProduct::create([
            'name' => 'Gold Coffee',
            'profitmargin' => 0.25,
        ]);


        $response = $this->actingAs($user)->postJson('/api/sales/calculateSalesPrice', [
            'quantity' => -5,
            'unitcost' => 10,
            'productid' => $coffeeproduct->id
        ]);

        $response->assertStatus(200);
        $response->assertJson(['sellingprice' => 0]);
    }
}
