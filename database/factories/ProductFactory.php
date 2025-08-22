<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->unique()->name();
        $slug=Str::slug($title);
        $subCategories=[16,17];
        $subCatRandKey= array_rand( $subCategories);
        $brand=[3,4,5,6];
        $brandRandKey=array_rand($brand);

        return [
            //
            'title' =>$title,
            'slug'=>$slug,
            'category_id'=>132,
            'subcategory_id'=> $subCategories[$subCatRandKey],
            'brand_id'=> $brand[$brandRandKey],
            'price'=>rand(10,10000),
            'sku'=>rand(1000,1000000),
            'track_qty'=>'Yes',
            'qty'=>10,
            'is_featured'=>'Yes',
            'status'=>1


        ];
    }
}
