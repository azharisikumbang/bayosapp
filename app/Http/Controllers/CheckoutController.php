<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::getContentWithDetail();
        
        return Inertia::render('Checkout/Index', [
            'carts' => $cart->toArray()
        ]);
    }
}
