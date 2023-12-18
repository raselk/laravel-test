<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CoffeeProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Sales Agent',
            'email' => 'sales@coffee.shop',
        ]);

        CoffeeProduct::factory()->create([
            'name' => 'Gold coffee',
            'profitmargin' => 0.25,
        ]);

        CoffeeProduct::factory()->create([
            'name' => 'Arabica coffee',
            'profitmargin' => 0.15,
        ]);
    }
}
