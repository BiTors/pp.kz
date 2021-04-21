<?php

namespace Database\Seeders;
use App\Models\product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        product::factory()->times(50)->create();
    }
}
