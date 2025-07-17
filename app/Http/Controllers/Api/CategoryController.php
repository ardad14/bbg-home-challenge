<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $products = Category::paginate(10);
        return response(CategoryResource::collection($products));
    }
}
