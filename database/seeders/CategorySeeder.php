<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Manual;

class CategorySeeder extends Seeder
{
    /**
     * Maakt de categorieen aan en zet elke handleiding in de juiste categorie.
     */
    public function run(): void
    {
        // Per categorie: welke merken erin vallen
        $categories = [
            'phones' => ['ALCATEL Mobile Phones', 'Huawei', 'ZTE', 'Motorola', 'Palm', 'LG Electronics', 'Samsung', 'Pantech', 'Aastra Telecom', 'VTech', 'Uniden', 'AT&T', 'RCA'],
            'computers' => ['BenQ', 'AOC', 'Toshiba', 'Dell', 'Fujitsu', 'Lenovo', 'Apple', 'Citizen'],
            'audio' => ['DigiTech', 'Yamaha', 'Samson', 'JBL', 'Crown Audio', 'MTX Audio', 'Musica', 'DCM Speakers', 'Pioneer', 'Sony'],
            'navigation' => ['Garmin', 'Humminbird', 'Furuno', 'IOGear'],
            'optics' => ['Carl Zeiss', 'Kowa'],
            'home_garden' => ['TPI Corporation', 'Land Pride', 'Kohler', 'ProForm', 'Grizzly', 'GE'],
        ];

        foreach ($categories as $slug => $brandNames) {
            $category = Category::firstOrCreate(['slug' => $slug]);
            $brandIds = Brand::whereIn('name', $brandNames)->pluck('id');

            Manual::whereIn('brand_id', $brandIds)->update(['category_id' => $category->id]);
        }

        // Uitzondering: deze Samsung is een laptop, geen telefoon
        $computers = Category::where('slug', 'computers')->first();
        Manual::where('name', 'QX410-S02')->update(['category_id' => $computers->id]);
    }
}
