<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Variant;
use App\Http\Requests\StoreVariantRequest;
use App\Http\Requests\UpdateVariantRequest;
use App\Models\VariantGroup;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Variant/Index', [
            'variants' => Variant::with('group')->latest()->paginate(10)->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $variantGroups = VariantGroup::all();
        if ($variantGroups->isEmpty()) return redirect()->route('admin-product-variant-group.index');

        return Inertia::render('Admin/Variant/Create', [
            'variant_groups' => $variantGroups->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVariantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariantRequest $request)
    {
        $validated = $request->validated();
        $variant = Variant::make([...$validated, 'variant_group_id' => $validated['group']]);
        $variant->save();

        return redirect()->route('admin-product-variant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVariantRequest  $request
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariantRequest $request, Variant $variant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        //
    }
}
