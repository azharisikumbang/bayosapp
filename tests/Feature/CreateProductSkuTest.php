<?php

namespace Tests\Feature;

use App\Models\Sku;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantGroup;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProductSkuTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product_sku_generate_valid_format()
    {
        $this->withoutExceptionHandling();
        $format = "BYS-%s-%s-%s-%s"; // {MERK}-{KATEGORI}-{UKURAN}-{WARNA}-{NOMOR_UNIT}

        $ukuran = VariantGroup::factory()->make([
            'name' => 'UKURAN',
            'sku_order' => 1
        ]);

        $warna = VariantGroup::factory()->make([
            'name' => 'WARNA',
            'sku_order' => 2
        ]);

        $L = Variant::factory()->make(['variant' => 'Large', 'label' => 'L'])->group()->associate($ukuran);
        $XL = Variant::factory()->make(['variant' => 'Extra Large', 'label' => 'XL'])->group()->associate($ukuran);
        $XXL = Variant::factory()->make(['variant' => 'Extra Extra Large', 'label' => 'XXL'])->group()->associate($ukuran);

        $Black = Variant::factory()->make(['variant' => 'Black', 'label' => 'BLK'])->group()->associate($warna);
        $White = Variant::factory()->make(['variant' => 'White', 'label' => 'WHT'])->group()->associate($warna);

        $productCategory = ProductCategory::factory(1)->make();
        $product = Product::factory()->make(['label' => 'PRDX1'])->category()->associate($productCategory);

        // dd(sprintf($format, $product->label, $L->label, $Black->label, 10));
        
        $variants = [$L, $XL, $Black, $White];

        $sku = new Sku();
        $sku = $sku->generateSkuValue($product, ...$variants);

        $variants = Variant::all();
        $products = Product::all();
    }
}
