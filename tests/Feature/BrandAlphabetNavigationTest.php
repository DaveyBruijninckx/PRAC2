<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandAlphabetNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_links_to_available_brand_letter_pages(): void
    {
        foreach (['Alpha Appliances', 'Zeta Works'] as $name) {
            $brand = new Brand();
            $brand->name = $name;
            $brand->save();
        }

        $response = $this->get('/')->assertOk();
        $content = $response->getContent();

        $this->assertStringContainsString('href="' . route('brands.by-letter', ['letter' => 'A']) . '">A</a>', $content);
        $this->assertStringContainsString('href="' . route('brands.by-letter', ['letter' => 'Z']) . '">Z</a>', $content);
        $this->assertStringContainsString('brand-letter-disabled" aria-disabled="true">B</span>', $content);
        $this->assertStringContainsString(__('site.brand_letter_intro'), $content);
        $this->assertStringNotContainsString('href="#brand-', $content);
    }

    public function test_letter_page_lists_only_matching_brands_with_links_to_brand_pages(): void
    {
        $brand = new Brand();
        $brand->name = 'Bosch';
        $brand->save();

        $otherBrand = new Brand();
        $otherBrand->name = 'Alpha Appliances';
        $otherBrand->save();

        $this->get('/B')
            ->assertOk()
            ->assertSee('Bosch')
            ->assertSee('href="/" title="' . __('misc.all_brands') . '">' . __('misc.all_brands') . '</a>', false)
            ->assertSee('class="brand-list-button" href="/' . $brand->id . '/Bosch/"', false)
            ->assertDontSee('Alpha Appliances');
    }

    public function test_letter_page_is_case_insensitive(): void
    {
        $brand = new Brand();
        $brand->name = 'Bosch';
        $brand->save();

        $this->get('/b')
            ->assertOk()
            ->assertSee('Bosch');
    }

    public function test_homepage_brand_heading_uses_the_selected_language(): void
    {
        $this->withSession(['locale' => 'nl'])
            ->get('/')
            ->assertOk()
            ->assertSee('<h2>' . __('misc.all_brands', [], 'nl') . '</h2>', false);

        $this->withSession(['locale' => 'en'])
            ->get('/')
            ->assertOk()
            ->assertSee('<h2>' . __('misc.all_brands', [], 'en') . '</h2>', false);
    }
}
