<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandAlphabetNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_links_to_available_brand_letter_sections(): void
    {
        foreach (['Alpha Appliances', 'Zeta Works'] as $name) {
            $brand = new Brand();
            $brand->name = $name;
            $brand->save();
        }

        $response = $this->get('/')->assertOk();
        $content = $response->getContent();

        $this->assertStringContainsString('href="#brand-A">A</a>', $content);
        $this->assertStringContainsString('href="#brand-Z">Z</a>', $content);
        $this->assertStringContainsString('id="brand-A">A</h2>', $content);
        $this->assertStringContainsString('id="brand-Z">Z</h2>', $content);
        $this->assertStringContainsString('brand-letter-disabled" aria-disabled="true">B</span>', $content);
    }
}
