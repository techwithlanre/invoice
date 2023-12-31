<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $productCategories = ProductCategory::where('user_id', auth()->user()->id)->get();
        return Inertia::render('ProductCategories/ProductCategoryIndex', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('ProductCategories/CreateProductCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        ProductCategory::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
        ]);

        return to_route('product.category.index')->with('message', 'Product category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return Inertia::render('ProductCategories/EditProductCategory', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $productCategory->name = $request->name;
        $productCategory->save();

        return to_route('product.category.index')->with('message', 'Product category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return to_route('product.category.index')->with('message', 'Product category deleted successfully');
    }
}
