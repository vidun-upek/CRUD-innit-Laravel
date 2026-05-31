<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric|between:0,999999.99',
            'description' => 'nullable'
        ]);

        Product::create($data);

        return redirect(route('product.index'))->with('success', 'Product Created Successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric|between:0,999999.99',
            'description' => 'nullable'
        ]);

        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product Updated Successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('product.index'))->with('success', 'Product Deleted Successfully!');
    }
}