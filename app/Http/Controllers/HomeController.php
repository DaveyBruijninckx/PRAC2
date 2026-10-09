<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;
use App\Models\Category;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all()->sortBy('name');
        $brands = Brand::all()->sortBy('name');
        $popularManuals = Manual::with('brand')
            ->orderByDesc('view_count')
            ->orderBy('id')
            ->limit(10)
            ->get();
        $name = "Kenan";
        $surname = "Keles";

        return view('pages.homepage')
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('popularManuals', $popularManuals)
            ->with('name', $name)
            ->with('surname', $surname);
    }
}
