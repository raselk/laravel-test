<?php

namespace Tests\Feature;

use App\Models\CoffeeProduct;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\SaleSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_redirect(): void
    {
        $response = $this->get('/sales');

        $response->assertStatus(302)
            ->assertRedirectToRoute('login');
    }

    public function test_authorised_access_granted(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/sales');

        $response->assertStatus(200);
    }

    public function test_empty_sales_table(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/sales');

        $response->assertStatus(200);
        $response->assertSee("No sales to report yet");
    }

    public function test_empty_sales_has_items(): void
    {
        $user = User::factory()->create();

        $this->seed(SaleSeeder::class);

        $response = $this->actingAs($user)->get('/sales');

        $response->assertStatus(200);
        $response->assertDontSee("No sales to report yet");
    }

    public function test_adding_a_new_sale(): void
    {
        $user = User::factory()->create();
        $coffee = CoffeeProduct::factory()->create();

        $response = $this->actingAs($user)->post('/sale', [
            'quantity' => 1,
            'unitcost' => 10,
            'productid' => $coffee->id,
        ]);

        $response->assertStatus(302)
            ->assertRedirectToRoute('coffee.sales');
    }

    public function test_adding_a_negative_quantity_fail(): void
    {
        $user = User::factory()->create();
        $coffee = CoffeeProduct::factory()->create();

        $response = $this->actingAs($user)->post('/sale', [
            'quantity' => -1,
            'unitcost' => 10,
            'productid' => $coffee->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseEmpty('sales');
    }

    public function test_adding_a_negative_unitcost_fail(): void
    {
        $user = User::factory()->create();
        $coffee = CoffeeProduct::factory()->create();


        $response = $this->actingAs($user)->post('/sale', [
            'quantity' => 1,
            'unitcost' => -10,
            'productid' => $coffee->id,

        ]);

        $response->assertStatus(302);
        $this->assertDatabaseEmpty('sales');
    }

    public function test_adding_a_succesfull_sale(): void
    {
        $user = User::factory()->create();
        $coffee = CoffeeProduct::factory()->create();

        $response = $this->actingAs($user)->post('/sale', [
            'quantity' => 1,
            'unitcost' => 10,
            'productid' => $coffee->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount('sales', 1);
    }
}
