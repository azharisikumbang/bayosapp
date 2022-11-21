<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): Response
    {
        $productCategories = ProductCategory::with('children')->whereNull('parent')->get();
        $products = Product::with([
            'category' => fn($q) => $q->select(['id', 'name', 'display_name'])
        ])
        ->select(['name', 'price', 'product_category_id', 'thumbnail', 'slug'])
        ->get(); 

        return Inertia::render('Home/Index', [
            'menus' => $productCategories->toArray(),
            'products' => $products->toArray()
        ]);
    }
}
