<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
    public function byLetter(string $letter)
    {
        $letter = strtoupper($letter);
        $brands = Brand::where('name', 'like', $letter . '%')
            ->orderBy('name')
            ->get();

        abort_if($brands->isEmpty(), 404);

        return view('pages.brands_by_letter', [
            'letter' => $letter,
            'brands' => $brands,
        ]);
    }

    public function show(string $brand_id, string $brand_slug)
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
