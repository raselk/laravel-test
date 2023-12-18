<?php

namespace Database\Seeders;

use App\Models\CoffeeProduct;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoffeeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoffeeProduct::factory(10)->create();
    }
}
