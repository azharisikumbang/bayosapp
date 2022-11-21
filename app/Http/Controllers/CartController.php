<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCartItemRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Cart/Index', [
            'carts' => (Cart::getContentWithDetail())->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartItemRequest $request)
    {
        $cartItemRequest = $request->validated();
        $product = Product::find($cartItemRequest['product']);
        Cart::add($product->id, $cartItemRequest['quantity'], $product->price, $cartItemRequest['variants']);

        return redirect()
            ->route('cart.index')
            ->with(['status' => 201, 'message' => 'Item berhasil ditambahkan ke keranjang.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $cart)
    {
        Cart::updateQuantity($cart->id, $request->quantity);

        return response()->json((Cart::getContent())->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $cart)
    {
        Cart::remove($cart->id);

        return response()->json((Cart::getContent())->toArray());
    }
}
