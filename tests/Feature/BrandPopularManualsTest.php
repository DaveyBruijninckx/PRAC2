<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Manual;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandPopularManualsTest extends TestCase
{
    use RefreshDatabase;

    public function test_brand_page_shows_its_five_most_viewed_manuals_before_the_full_list(): void
    {
        $brand = new Brand();
        $brand->name = 'Example Brand';
        $brand->save();

        $otherBrand = new Brand();
        $otherBrand->name = 'Other Brand';
        $otherBrand->save();

        $manuals = [];
        for ($index = 1; $index <= 7; $index++) {
            $manual = new Manual();
            $manual->brand_id = $brand->id;
            $manual->name = "Type {$index}.";
            $manual->filesize = 0;
            $manual->originUrl = 'https://example.com/manual';
            $manual->view_count = $index;
            $manual->save();
            $manuals[$index] = $manual;
        }

        $otherManual = new Manual();
        $otherManual->brand_id = $otherBrand->id;
        $otherManual->name = 'Other type.';
        $otherManual->filesize = 0;
        $otherManual->originUrl = 'https://example.com/other-manual';
        $otherManual->view_count = 100;
        $otherManual->save();

        $brandUrl = "/{$brand->id}/{$brand->getNameUrlEncodedAttribute()}/";
        $response = $this->get($brandUrl)->assertOk();
        $content = $response->getContent();
        [$popularSection] = explode('<section id="all-manuals">', $content, 2);
        [, $allSection] = explode('<section id="all-manuals">', $content, 2);

        $this->assertSame(5, substr_count($popularSection, 'class="popular-manual-link"'));
        $this->assertSame(5, substr_count($popularSection, 'class="popular-manual-rank"'));
        $this->assertStringContainsString('<ol class="popular-manual-list">', $popularSection);
        $this->assertStringContainsString(__('introduction_texts.popular_manuals'), $popularSection);
        $this->assertStringContainsString(__('introduction_texts.all_manuals'), $allSection);
        $this->assertStringNotContainsString($otherManual->name, $content);

        $previousLinkPosition = -1;
        foreach ([7, 6, 5, 4, 3] as $rank => $index) {
            $manualUrl = "href=\"{$brandUrl}{$manuals[$index]->id}/\"";
            $this->assertStringContainsString('<span class="popular-manual-rank">' . ($rank + 1) . '.</span>', $popularSection);
            $this->assertStringContainsString($manualUrl, $popularSection);
            $this->assertStringContainsString($manuals[$index]->name, $popularSection);
            $this->assertStringContainsString(__('introduction_texts.manual_views', ['count' => $manuals[$index]->view_count]), $popularSection);
            $linkPosition = strpos($popularSection, $manualUrl);
            $this->assertGreaterThan($previousLinkPosition, $linkPosition);
            $previousLinkPosition = $linkPosition;
        }

        $this->assertStringNotContainsString($manuals[2]->name, $popularSection);
        $this->assertStringNotContainsString($manuals[1]->name, $popularSection);
        $this->assertStringContainsString($manuals[1]->name, $content);

        foreach ($manuals as $index => $manual) {
            $expectedLinkCount = $index >= 3 ? 2 : 1;
            $this->assertSame($expectedLinkCount, substr_count($content, ">{$manual->name}</a>"));
            $this->assertStringContainsString(">{$manual->name}</a>", $allSection);
        }
    }
}
