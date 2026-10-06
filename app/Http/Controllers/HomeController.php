<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class HomeController extends Controller
{
    public function home()
    {
        $brands = Brand::all()->sortBy('name');
        $popularManuals = Manual::with('brand')
            ->orderByDesc('view_count')
            ->orderBy('id')
            ->limit(10)
            ->get();
        $name = "Kenan";
        $surname = "Keles";

        return view('pages.homepage')
            ->with('brands', $brands)
            ->with('popularManuals', $popularManuals)
            ->with('name', $name)
            ->with('surname', $surname);
    }
}
