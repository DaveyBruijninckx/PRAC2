<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {

        $brand = Brand::findOrFail($brand_id);
        $popularManuals = Manual::where('brand_id', $brand_id)
            ->orderByDesc('view_count')
            ->limit(5)
            ->get();
        $manuals = Manual::where('brand_id', $brand_id)->get();

        return view('pages/manual_list', [
            "brand" => $brand,
            "manuals" => $manuals,
            "popularManuals" => $popularManuals,
        ]);

    }
}
