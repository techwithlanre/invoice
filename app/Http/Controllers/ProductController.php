<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->user()->id)->get();
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->code,
                'price' => number_format($product->price, 2),
                'type' => $product->type,
                'category' => ProductCategory::find($product->product_category_id)?->name
            ];
        });

        return Inertia::render('Products/ProductIndex', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Products/CreateProduct', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Product::create([
            'name' => $request->name,
            'code' => "#" . str_pad(Str::random(5),7,"0",STR_PAD_LEFT),
            'user_id' => auth()->user()->id,
            'product_category_id' => $request->product_category,
            'type' => $request->product_type,
            'price' => $request->price
        ]);
        return to_route('product.index')->with('message', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.s
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Products/EditProduct', compact('product', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->product_category_id = $request->product_category;
        $product->type = $request->product_type;
        $product->price = $request->price;
        $product->save();

        return to_route('product.index')->with('message', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('product.index')->with('message', 'Product deleted successfully');
    }
}
