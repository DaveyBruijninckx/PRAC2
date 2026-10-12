<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Manual;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryOverviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_overview_lists_all_categories_and_links_to_each_category(): void
    {
        $phones = Category::create(['slug' => 'phones']);
        $computers = Category::create(['slug' => 'computers']);

        $this->get('/categories/')
            ->assertOk()
            ->assertSee(__('site.categories'))
            ->assertSee('href="/category/' . $phones->id . '/phones/"', false)
            ->assertSee(__('categories.phones'))
            ->assertSee('href="/category/' . $computers->id . '/computers/"', false)
            ->assertSee(__('categories.computers'));
    }

    public function test_navigation_links_to_the_category_overview(): void
    {
        $category = Category::create(['slug' => 'phones']);

        $this->get('/')
            ->assertOk()
            ->assertSee('href="' . route('categories') . '"', false)
            ->assertSee(__('site.categories'))
            ->assertSee(__('site.view_all_categories'))
            ->assertDontSee('href="/category/' . $category->id . '/phones/"', false);
    }

    public function test_category_breadcrumbs_allow_stepping_back_through_the_navigation(): void
    {
        $category = Category::create(['slug' => 'phones']);
        $brand = new Brand();
        $brand->name = 'Example Brand';
        $brand->save();

        $manual = new Manual();
        $manual->brand_id = $brand->id;
        $manual->category_id = $category->id;
        $manual->name = 'Example Manual';
        $manual->filesize = 0;
        $manual->originUrl = 'https://example.com/manual';
        $manual->save();

        $this->get('/categories/')
            ->assertOk()
            ->assertSee(__('misc.home'))
            ->assertSee(__('site.categories'));

        $categoryUrl = "/category/{$category->id}/phones/";
        $this->get($categoryUrl)
            ->assertOk()
            ->assertSee('href="' . route('categories') . '"', false)
            ->assertSee('href="' . $categoryUrl . '"', false);

        $brandUrl = "{$categoryUrl}{$brand->id}/{$brand->getNameUrlEncodedAttribute()}/";
        $this->get($brandUrl)
            ->assertOk()
            ->assertSee('href="' . route('categories') . '"', false)
            ->assertSee('href="' . $categoryUrl . '"', false)
            ->assertSee('href="' . $brandUrl . '"', false);
    }
}
