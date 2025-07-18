<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::with('category')->paginate(10);
        return response(ProductResource::collection($products));
    }

    public function show(Product $product): Response
    {
        $product->load('category');
        return response(new ProductResource($product));
    }
}
