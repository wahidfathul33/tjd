<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        return Product::with(['brand', 'category' , 'reviews', 'variants'])
        ->active()
        ->first();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return $product->load(['brand', 'category' , 'reviews', 'variants']);
    }

    public function update(Request $request, Product $product)
    {
        //
    }
    
    public function destroy(Product $product)
    {
        //
    }
}
