<?php

namespace Tests\Feature;

use Tests\TestCase;

class HotelSearchTest extends TestCase
{
    public function test_homepage_renders_trivago_search_interface(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Trivago');
        $response->assertSee('Bestemming of Hotelnaam');
        $response->assertSee('Zoek Hotels');
    }

    public function test_public_hotel_search_filters_by_city(): void
    {
        $response = $this->get('/?city=Amsterdam');

        $response->assertStatus(200);
        $response->assertSee('Amsterdam');
    }

    public function test_public_hotel_search_filters_by_stars(): void
    {
        $response = $this->get('/?min_star=5');

        $response->assertStatus(200);
    }

    public function test_public_hotel_search_filters_by_price_range(): void
    {
        $response = $this->get('/?min_price=100&max_price=300');

        $response->assertStatus(200);
    }
}
