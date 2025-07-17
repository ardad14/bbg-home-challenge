<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categoryId = $request->get('category');
        $search = $request->get('search');

        $query = Product::with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories', 'categoryId', 'search'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }
}
