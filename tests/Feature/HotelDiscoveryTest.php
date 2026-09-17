<?php

namespace Tests\Feature;

use App\Models\Hotel;
use Database\Seeders\HotelSeeder;
use Tests\TestCase;

class HotelDiscoveryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(HotelSeeder::class);
    }

    public function test_homepage_renders_gshotel_branding_and_sanctuaries(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('GSHotel');
        $response->assertSee('Reserved');
        $response->assertSee('Sanctuaries');
    }

    public function test_public_hotel_search_filters_by_city(): void
    {
        $response = $this->get('/?city=Amsterdam');

        $response->assertStatus(200);
        $response->assertSee('Amsterdam');
    }

    public function test_public_hotel_search_filters_by_stars(): void
    {
        $response = $this->get('/?stars=5');

        $response->assertStatus(200);
        $response->assertSee('5 ★ Luxury');
    }

    public function test_hotel_detail_page_renders_sanctuary_info(): void
    {
        $hotel = Hotel::first();
        $this->assertNotNull($hotel);

        $response = $this->get('/hotels/'.$hotel->id);

        $response->assertStatus(200);
        $response->assertSee($hotel->name);
        $response->assertSee('Reserve Your Stay');
    }

    public function test_hotel_detail_handles_non_existent_id(): void
    {
        $response = $this->get('/hotels/99999');

        $response->assertStatus(404);
    }
}
