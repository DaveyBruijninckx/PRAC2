<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Manual;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManualViewCountTest extends TestCase
{
    use RefreshDatabase;

    public function test_opening_a_manual_increments_its_view_count(): void
    {
        $brand = new Brand();
        $brand->name = 'Example Brand';
        $brand->save();

        $manual = new Manual();
        $manual->brand_id = $brand->id;
        $manual->name = 'Example Manual';
        $manual->filesize = 0;
        $manual->originUrl = 'https://example.com/manual';
        $manual->save();

        $this->assertSame(0, $manual->fresh()->view_count);

        $brandUrl = "/{$brand->id}/{$brand->getNameUrlEncodedAttribute()}/";
        $url = "{$brandUrl}{$manual->id}/";
        $this->get($brandUrl)
            ->assertOk()
            ->assertSee('href="' . $url . '"', false)
            ->assertSee('class="manual-link-button"', false);

        $this->get($url)
            ->assertOk()
            ->assertSee('Views: 1')
            ->assertSee('class="manual-download-button"', false);
        $this->get($url)->assertOk()->assertSee('Views: 2');

        $this->assertDatabaseHas('manuals', [
            'id' => $manual->id,
            'view_count' => 2,
        ]);
    }
}
