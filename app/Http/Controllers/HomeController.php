<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class HomeController extends Controller
{
    public function home()
    {
        $brands = Brand::all()->sortBy('name');
        $name = "Kenan";
        $surname = "Keles";

        return view('pages.homepage')
            ->with('brands', $brands)
            ->with('name', $name)
            ->with('surname', $surname);
    }
}
