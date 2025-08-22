<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('subcategories')->insert([
            ['name' => 'Educational Toys', 'slug' => 'educational-toys', 'category_id' => 148, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soft Toys', 'slug' => 'soft-toys', 'category_id' => 148, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Winter Clothes', 'slug' => 'winter-clothes', 'category_id' => 149, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
