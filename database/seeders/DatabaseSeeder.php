<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantGroup;
use App\Models\ProductCategory;
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
        $ukuran = VariantGroup::factory()->create(['name' => 'UKURAN']);
        $warna = VariantGroup::factory()->create(['name' => 'WARNA']);

        $ukuran->variants()->saveMany([
            Variant::factory()->make(['variant' => 'Large', 'label' => 'L']),
            Variant::factory()->make(['variant' => 'Extra Large', 'label' => 'XL']),
            Variant::factory()->make(['variant' => 'Extra Extra Large', 'label' => 'XXL'])
        ]);

        $warna->variants()->saveMany([
            Variant::factory()->make(['variant' => 'Black', 'label' => 'BLK']),
            Variant::factory()->make(['variant' => 'White', 'label' => 'WHT'])
        ]);

        $productCategory = ProductCategory::factory(20)->create();

        // $productCategory->each(function($category) {
        //     $products = Product::factory(10)->create();
        //     $category->products()->saveMany($products);
        // });

        
    }
}
