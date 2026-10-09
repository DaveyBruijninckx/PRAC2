<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Manual;

class CategoryController extends Controller
{
    // Stap 1: alle merken binnen een categorie
    public function show($category_id, $category_slug)
    {
        $category = Category::findOrFail($category_id);
        $brands = $category->brands();

        return view('pages.category_brands')
            ->with('category', $category)
            ->with('brands', $brands);
    }

    // Stap 2: alle modellen van een merk binnen een categorie
    public function brand($category_id, $category_slug, $brand_id, $brand_slug)
    {
        $category = Category::findOrFail($category_id);
        $brand = Brand::findOrFail($brand_id);
        $manuals = Manual::where('category_id', $category_id)
            ->where('brand_id', $brand_id)
            ->orderBy('name')
            ->get();

        return view('pages.category_manuals')
            ->with('category', $category)
            ->with('brand', $brand)
            ->with('manuals', $manuals);
    }
}
