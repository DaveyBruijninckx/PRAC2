<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function manuals()
    {
        return $this->hasMany(Manual::class);
    }

    // De naam komt uit het taalbestand, zodat hij meewisselt met NL/EN
    public function getNameAttribute()
    {
        return __('categories.' . $this->slug);
    }

    // Alle merken die minstens een handleiding in deze categorie hebben
    public function brands()
    {
        return Brand::whereIn('id', $this->manuals()->select('brand_id'))->orderBy('name')->get();
    }
}
