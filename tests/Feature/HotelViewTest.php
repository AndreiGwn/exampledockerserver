<?php

namespace Tests\Feature;

use Tests\TestCase;

class HotelViewTest extends TestCase
{
    public function test_hotel_detail_page_can_be_rendered(): void
    {
        $response = $this->get('/hotels/1');

        $response->assertStatus(200);
        $response->assertSee('Terug naar resultaten');
    }

    public function test_hotel_detail_page_handles_non_existent_id_gracefully(): void
    {
        $response = $this->get('/hotels/99999');

        $response->assertStatus(200);
    }
}
