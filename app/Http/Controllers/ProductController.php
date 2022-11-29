<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductStoreValidation;
use App\Http\Requests\Admin\ProductUpdateValidation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreValidation $request)
    {
        $validation = $request->validated();
        unset($validation['image']);
        if($request->hasFile('image')){
            $photo = $request->file('image')->store('public');
            $validation['image'] =explode('/', $photo)[1];
        }
        Product::create($validation);
        return redirect()->route('admin.product.index')->with(['store'=>true]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateValidation $request, Product $product)
    {
        $validation = $request->validated();
        unset($validation['image']);
        if($request->hasFile('image')){
            $photo = $request->file('image')->store('public');
            $validation['image'] =explode('/', $photo)[1];
        }
        $product->update($validation);
        return redirect()->route('admin.product.index')->with(['update'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with(['destroy'=>true]);
    }
}
