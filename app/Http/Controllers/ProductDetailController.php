<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request, Product $product)
    {
        $productDetails = $product->getAllProductDetails()->toArray();

        $viewData = [
            'id' => $productDetails['id'],
            'name' => $productDetails['name'],
            'label' => $productDetails['label'],
            'thumbnail_location' => $productDetails['thumbnail_location'],
            'description' => $productDetails['description'],
            'price' => $productDetails['price'],
            'slug' => $productDetails['slug'],
            'images' => $productDetails['images'],
            'category' => $productDetails['category']['display_name'],
            'available_variants' => $productDetails['detail'],
            'variants' => []
        ];

        $temp = [];
        foreach ($productDetails['detail'] as $variant) {
            
            foreach($variant['variants'] as $v) {
                $temp[$v['group']['name']][$v['id']] = [
                    'id' => $v['id'],
                    'name' => $v['variant'],
                    'label' => $v['label'],
                    'is_selected' => false
                ];
            }
        }

        $viewData['variants'] = $temp;

        return Inertia::render('Product/Show', ['product' => $viewData]);
    }
}
 