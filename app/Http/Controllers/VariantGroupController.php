<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\VariantGroup;
use App\Http\Requests\StoreVariantGroupRequest;
use App\Http\Requests\UpdateVariantGroupRequest;

class VariantGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/VariantGroup/Index', [
            'variant_groups' => VariantGroup::latest()->paginate(10)->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/VariantGroup/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVariantGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariantGroupRequest $request)
    {
        VariantGroup::create($request->validated());

        return redirect()->route('admin-product-variant-group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function show(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVariantGroupRequest  $request
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariantGroupRequest $request, VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariantGroup $variantGroup)
    {
        //
    }
}
