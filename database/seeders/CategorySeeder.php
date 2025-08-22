<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('categories')->insert([
            [
                'category_name' => 'Baby Toys',
                'category_slug' => 'baby-toys',
                'category_img' => 'https://via.placeholder.com/300x300?text=Baby+Toys', // Example image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Baby Clothes',
                'category_slug' => 'baby-clothes',
                'category_img' => 'https://via.placeholder.com/300x300?text=Baby+Clothes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Baby Gear',
                'category_slug' => 'baby-gear',
                'category_img' => 'https://via.placeholder.com/300x300?text=Baby+Gear',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
