<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Elit reprehenderit',
            'price' => 19.00,
            'quantity' => 5,
            'category_id' => 1,
            'brand_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipis'


        ]);
    }
}
