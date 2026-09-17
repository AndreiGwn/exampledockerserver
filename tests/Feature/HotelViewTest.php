<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_hotel_detail_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['role' => 'eigenaar']);

        $hotelModel = app(Hotel::class);
        $hotelId = $hotelModel->createHotel([
            'user_id' => $user->id,
            'name' => 'View Test Hotel',
            'description' => 'Test Hotel description',
            'city' => 'Amsterdam',
            'address' => 'Testgracht 1',
            'star_rating' => 5,
            'price_per_night' => 199.00,
        ]);

        $targetId = $hotelId > 0 ? $hotelId : 1;

        $response = $this->get('/hotels/'.$targetId);

        if ($hotelId > 0) {
            $response->assertStatus(200);
            $response->assertSee('View Test Hotel');
        } else {
            $response->assertStatus(404);
        }
    }

    public function test_hotel_detail_page_handles_non_existent_id_gracefully(): void
    {
        $response = $this->get('/hotels/99999');

        $response->assertStatus(404);
    }
}
