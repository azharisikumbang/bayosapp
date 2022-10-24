<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Product;
use App\Models\Variant;
use App\Http\Requests\StoreSkuRequest;
use App\Http\Requests\UpdateSkuRequest;
use Illuminate\Database\Grammar;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkuRequest $request, Product $product)
    {
        $validated = $request->validated();
        
        foreach ($validated['selectedVariants'] as $requestVariants) {
            $sku = new Sku([
                'additional_price' => $requestVariants['price'],
                'quantity' => $requestVariants['quantity']
            ]);

            $variants = [];
            foreach($requestVariants['variants'] as $selectedVariant) $variants[] = $selectedVariant['value'];
            
            $variants = Variant::with('group')->findMany($variants);
            $sku->generateSkuValue($product, $variants);
            $sku->product()->associate($product);
            $sku->save();
            $sku->variants()->attach($variants);
        }


        return redirect()->route('admin-product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function show(Sku $sku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function edit(Sku $sku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkuRequest  $request
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkuRequest $request, Sku $sku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sku $sku)
    {
        //
    }
}
