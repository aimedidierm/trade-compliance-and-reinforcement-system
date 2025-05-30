<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->where('user_id', Auth::id())->paginate(10);
        return view('seller.product.products', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'invoice' => $request->input('invoice'),
            'price' => $request->input('price'),
            'user_id' => Auth::id(),
        ]);

        return redirect('/seller/products')->with('success', 'Product created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect('/seller/products')->with('success', 'Product deleted successfully.');
        } else {
            return redirect('/seller/products')->withErrors('Product not found');
        }
    }
}
