<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $activeCategory = $request->get('category');

        $products = Product::query()
            ->where('is_active', true)
            ->with('category')
            ->when($activeCategory, function ($query, $slug) {
                $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('shop', compact('categories', 'products', 'activeCategory'));
    }
}
