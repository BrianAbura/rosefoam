<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroBanners = Banner::query()
            ->where('is_active', true)
            ->where('placement', 'homepage_hero')
            ->where(function ($q) {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->get();

        $promoBanner = Banner::query()
            ->where('is_active', true)
            ->where('placement', 'homepage_promo')
            ->where(function ($q) {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->first();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $products = Product::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(8)
            ->get();

        $whyPage = Page::query()
            ->where('is_published', true)
            ->where('slug', 'why-rosefoam')
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->first();

        return view('home', compact(
            'heroBanners',
            'promoBanner',
            'categories',
            'products',
            'whyPage'
        ));
    }
}
