<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('brands')->insert([
            ['name' => 'Fisher-Price', 'slug' => 'fisher-price','status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lego', 'slug' => 'lego','status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mothercare', 'slug' => 'mothercare','status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
