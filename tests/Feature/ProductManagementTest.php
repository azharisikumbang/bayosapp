<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_product_page_show_successfully_with_data()
    {
        $response = $this->get('/product');

        $response->assertStatus(200);
    }
}
